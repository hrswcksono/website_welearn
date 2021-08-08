from keras.preprocessing import image
from keras.layers import Dense,GlobalAveragePooling2D,Dropout#,GlobalMaxPooling2D
# from keras.preprocessing.image import ImageDataGenerator
from keras.applications.mobilenet import MobileNet#, preprocess_input
from keras.models import Model
# from keras.callbacks import EarlyStopping, ModelCheckpoint, ReduceLROnPlateau
# import matplotlib.pyplot as plt
import numpy as np
# from tensorflow.keras.optimizers import Adam
import os,sys


# predictCNN Putri


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
    
    # x=Dense(1024,activation='relu')(x) #we add dense layers so that the model can learn more complex functions and classify for better results.
    # x=Dropout(0.1)(x)   
    # x=Dense(1024,activation='relu')(x) #dense layer 2
    # x=Dropout(0.1)(x)   
    # x=Dense(512,activation='relu')(x) #dense layer 3   
    # x=Dropout(0.1)(x)   
    # x=Dense(2048,activation='relu')(x) #we add dense layers so that the model can learn more complex functions and classify for better results.
    # x=Dropout(0.1)(x)   
    x=Dense(1024,activation='relu')(x) #dense layer 2
    x=Dropout(0.1)(x)   
    x=Dense(512,activation='relu')(x) #dense layer 3   
    x=Dropout(0.1)(x) 
    
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

def load_image(img_path, img_size) :

    img = image.load_img(img_path, target_size=(img_size, img_size))
    img_tensor = image.img_to_array(img)                    # (height, width, channels)
    img_tensor = np.expand_dims(img_tensor, axis=0)         # (1, height, width, channels), add a dimension because the model expects this shape: (batch_size, height, width, channels)
    img_tensor /= 255.                                      # imshow expects values in the range [0, 1]


    return img_tensor


if __name__ == "__main__":        
    # nmFile ='F:\\KULIAH ITS PUTRI\\SEMESTER 8 (2021)\\TUGAS AKHIR\\TA Putri\\predictHuruf\\coba_predict7.png'
    nmFile =sys.argv[1]
    mapClass = sys.argv[2]
    # mapClass = 'map.npz'
    if os.path.exists(mapClass):             
        loaded = np.load(mapClass)
        mapHuruf  = loaded['mapHuruf']

    img_size = 224
    bntk_input = (img_size, img_size, 3)
    kelas=len(mapHuruf)
    fold_no=2
    nmModel = (sys.argv[3]) # kalo error sys.argv[3] dikasih quote
    # nmModel  = ('modelCNN_fold_1.h5')
    # nmModel  = 'mobileNetCNN_097.h5'#-> model_save   
    model = mobileNetCNN(bntk_input,kelas) 
    if os.path.exists(nmModel):             
        model.load_weights(nmModel) 
        img      = load_image(nmFile, img_size)
        # pred     = model.predict(img)
        pred     = model(img)
        idxHuruf = np.argmax(pred)
        
        # print("prediksi %s"%mapHuruf[idxHuruf])
        print("%s"%mapHuruf[idxHuruf])
            

        
        
    
    
    






