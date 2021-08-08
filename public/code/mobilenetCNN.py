from keras.layers import Dense,GlobalAveragePooling2D,Dropout
from keras.preprocessing.image import ImageDataGenerator
from keras.applications.mobilenet import MobileNet#, preprocess_input
from keras.models import Model
from keras.callbacks import EarlyStopping, ModelCheckpoint, ReduceLROnPlateau
import numpy as np
import pandas as pd
from sklearn.metrics import accuracy_score
from sklearn.model_selection import StratifiedShuffleSplit
from tensorflow.keras.backend import clear_session
import os
# os.environ["CUDA_VISIBLE_DEVICES"] = "-1"


def mobileNetCNN(bntk_input,kelas):
    base_model=MobileNet(weights='imagenet',include_top=False,
                          input_shape=bntk_input
                          ) #imports the mobilenet model and discards the last 1000 neuron layer.

    x=base_model.output
    x=GlobalAveragePooling2D()(x)
    # x=GlobalMaxPooling2D()(x)
    # x=Dense(512,activation='relu')(x) #we add dense layers so that the model can learn more complex functions and classify for better results.
    # x=Dropout(0.3)(x)   
    # x=Dense(1380,activation='relu')(x) #dense layer 2
    # x=Dropout(0.3)(x)   
    # x=Dense(2048,activation='relu')(x) #dense layer 3   
    # x=Dropout(0.1)(x)   
    
    # x=Dense(2048,activation='relu')(x) #we add dense layers so that the model can learn more complex functions and classify for better results.
    # x=Dropout(0.1)(x)   
    x=Dense(1024,activation='relu')(x) #dense layer 2
    x=Dropout(0.1)(x)   
    x=Dense(512,activation='relu')(x) #dense layer 3   
    x=Dropout(0.1)(x)   
    # x=Dense(256,activation='relu')(x) #dense layer 3   
    # x=Dropout(0.1)(x)   
    preds=Dense(kelas,activation='softmax')(x) #final layer with softmax activation
    model=Model(inputs=base_model.input,outputs=preds)
    # for layer in model.layers:
    #     layer.trainable=False
    #     # or if we want to set the first 20 layers of the network to be non-trainable
    # for layer in model.layers[:20]:
    #     layer.trainable=False
    # for layer in model.layers[20:]:
    #     layer.trainable=True
    model.compile(optimizer='Adam',#Adam()#0.0001),
                  loss='categorical_crossentropy',
                  metrics=['accuracy'])
    return model

# def modelCNN(input_shape,nb_classes):
#     from keras.models import Sequential
#     #importing layers
#     from keras.layers import Conv2D,MaxPooling2D,Flatten,Dense,Dropout
#     from tensorflow.keras.optimizers import Adam
    
#     model=Sequential()
#     #adding layers and forming the model
#     model.add(Conv2D(64,kernel_size=2,strides=1,padding="Same",activation="relu",input_shape=input_shape))
#     model.add(MaxPooling2D(padding="same"))
    
#     model.add(Conv2D(96,kernel_size=2,strides=1,padding="same",activation="relu"))
#     model.add(MaxPooling2D(padding="same"))
    
#     model.add(Flatten())
    
#     model.add(Dense(1024,activation="relu"))
#     model.add(Dropout(0.2))
#     model.add(Dense(nb_classes,activation="sigmoid"))
#     model.compile(
#                   # optimizer="adam",
#                   optimizer=Adam(0.0001),loss="categorical_crossentropy",metrics=["accuracy"])

#     return model


def get_callbacks(name_weights, patience_lr):
    early_stopper = EarlyStopping(patience=15,monitor='val_loss')
    mcp_save = ModelCheckpoint(name_weights, save_best_only=True, monitor='val_loss', mode='min',verbose=1)
    reduce_lr_loss = ReduceLROnPlateau(monitor='val_loss', factor=0.01, patience=patience_lr, verbose=1, min_delta=1e-4, mode='min')
    return [mcp_save, reduce_lr_loss,early_stopper]


def getFile_andLabel(path):
    img_size = 224
    ig= ImageDataGenerator(rescale=1/255)  
    dt = ig.flow_from_directory(directory=path,
                                   target_size=(img_size, img_size),                                                  # subset="training",
                                   class_mode='categorical',                                                 
                                   )
    filepaths=dt.filepaths
    labels = (dt.class_indices)
    labels = dict((v,k) for k,v in labels.items())
    labelsTrue  = [labels[k] for k in dt.labels]
    return filepaths,labelsTrue

def getAllData():
    filename1,label1 = getFile_andLabel('TRAIN')
    return filename1,label1


if __name__ == "__main__":        
    mapClass = 'map.npz'    
    path="C:\\xampp\\htdocs\\welearn_web\\public\\dataset"
    mapHuruf=[]
    if not os.path.exists(mapClass):             
        for huruf in os.listdir(path):
            mapHuruf.append(huruf)
        mapHuruf=np.array(mapHuruf)
        np.savez_compressed(mapClass,mapHuruf=mapHuruf)   
        print("Saved Mapping huruf ")

    filename,label = getFile_andLabel(path)
    
    image_generator = ImageDataGenerator(rescale=1/255, 
                                           rotation_range=15,
                                           width_shift_range=0.2,
                                            height_shift_range=0.2,
                                           shear_range=0.2,
                                            zoom_range=0.2,
                                           # validation_split=0.1,#this is the trick
                                           # horizontal_flip=True
                                         )      
    image_generator2 = ImageDataGenerator(rescale=1/255, 
                                         )      
    
    imgData  =pd.DataFrame({"filepaths":filename,
                                "labels":label
                              })  
        
    
    fold_no = 1
    acc_per_fold = []
    loss_per_fold = []
    shuffle=True
    batch_size=16
    img_size = 224
    bntk_input = (img_size, img_size, 3)
    kelas = len(np.unique(label))
    
    sss = StratifiedShuffleSplit(n_splits=1, test_size=0.2, random_state=0)
    # sss = StratifiedShuffleSplit(n_splits=5, test_size=0.2, random_state=0)
    for train_index, val_index in sss.split(filename, label):
        training_data   = imgData.iloc[train_index]
        validation_data = imgData.iloc[val_index]
        clear_session()
        train_generator    = image_generator.flow_from_dataframe(
                                training_data, 
                                # directory = image_dir,
                                batch_size=batch_size,                                                 
						            x_col = "filepaths", 
                                y_col = "labels",
						            class_mode = "categorical", shuffle = True)
        
        validation_generator= image_generator2.flow_from_dataframe(
                                validation_data, 
                                # directory = image_dir,
                                batch_size=batch_size,                                                 
							        x_col = "filepaths", 
                                y_col = "labels",
							       class_mode = "categorical", shuffle = True)

                 
        print('------------------------------------------------------------------------')
        print(f'Training for fold {fold_no} ...')
    
        model = mobileNetCNN(bntk_input,kelas) 
        # model = modelCNN(bntk_input,kelas)
        nmModel  = 'modelCNN_fold_%d.h5'%fold_no#-> model_save
        callbacks = get_callbacks(nmModel, patience_lr=5)
        nb_epochs = len(train_index)
    
        history = model.fit(
            train_generator,
            steps_per_epoch = train_generator.samples // batch_size,
            validation_data = validation_generator, 
            validation_steps = validation_generator.samples // batch_size,
            epochs = nb_epochs,
            callbacks=callbacks,    
            )   
    
        model.load_weights(nmModel) 
        print("loaded success")  
        STEP_SIZE_TEST = validation_generator.n // validation_generator.batch_size
        scores = model.evaluate(validation_generator, steps=STEP_SIZE_TEST)
        validation_generator2= image_generator2.flow_from_dataframe(
                                validation_data, 
                                # directory = image_dir,
 							    x_col = "filepaths", 
                                y_col = "labels",
 							    class_mode = "categorical", shuffle = False)
        
        
        ypred = model.predict(validation_generator2)
        predicted_class_indices=np.argmax(ypred,axis=1)    
        scorePred = accuracy_score(predicted_class_indices,validation_generator2.labels)
        # print()
        labels_ori = (validation_generator2.class_indices)
        labels_ori = dict((v,k) for k,v in labels_ori.items())
        predictions = [labels_ori[k] for k in predicted_class_indices]
        labelsTrue  = [labels_ori[k] for k in validation_generator2.labels]

        filenames=validation_generator2.filenames
        results=pd.DataFrame({"Filename":filenames,
                    "labels":labelsTrue,
                  "Predictions":predictions})
        results.to_excel("result_%d_%.4f.xlsx"%(fold_no,scorePred),engine='openpyxl')
        

        
        print(f'Score for fold {fold_no}: {model.metrics_names[0]} of {scores[0]}; {model.metrics_names[1]} of {scores[1]*100}%')
        acc_per_fold.append(scores[1] * 100)
        loss_per_fold.append(scores[0])
    
        # Increase fold number
        fold_no = fold_no + 1
    
    # == Provide average scores ==
    print('------------------------------------------------------------------------')
    print('Score per fold')
    for i in range(0, len(acc_per_fold)):
      print('------------------------------------------------------------------------')
      print(f'> Fold {i+1} - Loss: {loss_per_fold[i]} - Accuracy: {acc_per_fold[i]}%')
    print('------------------------------------------------------------------------')
    print('Average scores for all folds:')
    print(f'> Accuracy: {np.mean(acc_per_fold)} (+- {np.std(acc_per_fold)})')
    print(f'> Loss: {np.mean(loss_per_fold)}')
    print('------------------------')



    