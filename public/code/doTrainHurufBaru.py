# -*- coding: utf-8 -*-
"""
Created on Thu May  6 10:06:46 2021

@author: asus
"""
DIM=224
IMG_DIM = (DIM, DIM)
input_shape = (DIM, DIM, 3)
import os,cv2
import numpy as np
from sklearn.linear_model import LogisticRegression
import pickle
import time
from sklearn.model_selection import StratifiedShuffleSplit
import pandas as pd
import glob


def createMobileNet():
    from keras.applications.mobilenet import MobileNet
    import keras
    from keras.models import Model
    
    mobileNet =  MobileNet(include_top=False, weights='imagenet', 
                                     input_shape=input_shape)

    output    = mobileNet.layers[-1].output
    output    = keras.layers.Flatten()(output)
    ModelmobileNet = Model(inputs=mobileNet.input, outputs=output)# base_model.get_layer('custom').output)

    ModelmobileNet.trainable = False
    for layer in ModelmobileNet.layers:
        layer.trainable = False
    return ModelmobileNet

def LoadImage(path,huruf,ModelmobileNet): 
    print("Huruf ...." + huruf)     
    fullPath = path + "\\" + huruf + "\\*.png"    
    images   = [cv2.resize(cv2.imread(file), IMG_DIM) for file in glob.glob(fullPath)]
    df = pd.DataFrame(ModelmobileNet.predict(np.array(images), verbose=1))
    df['huruf']=huruf
    return df
if __name__ == '__main__':
    FILE_ZIP = "all_huruf.gzip"
    t = time.time()
    if not os.path.exists(FILE_ZIP):
        print("Create data ...%s" %FILE_ZIP)    
        ModelmobileNet = createMobileNet()
        # path = "D:\TA\TA_Welearn\TA_PutriEndah\\dataset"
        path = "C:\\xampp\\htdocs\\welearn_web\\public\dataset"            
        df    = pd.concat((LoadImage(path,huruf,ModelmobileNet) for huruf in os.listdir(path)))        
        print("Saving ... %s"%FILE_ZIP)        
        df.to_pickle(FILE_ZIP)        
        elapsed = time.time() - t
        print("Time created & saved = {:.3f}".format(elapsed)) 
    else:
        print("File exist %s ... \nWaiting for load ..."%FILE_ZIP)
        df = pd.read_pickle(FILE_ZIP)
        elapsed = time.time() - t
        print("Time Load DB  = {:.3f}".format(elapsed))                   
            
    
    sss = StratifiedShuffleSplit(n_splits=1, test_size=0.5, random_state=0)    
    for train_index, test_index in sss.split(df.iloc[:,:-1], df.iloc[:,-1]):
        x_train, x_test = df.iloc[train_index,:-1], df.iloc[test_index,:-1]        
        y_train, y_test = df.iloc[train_index,-1], df.iloc[test_index,-1]
        print("Fitting model ....")        
        modelLR = LogisticRegression(solver='lbfgs',n_jobs=-1, multi_class='auto',tol=0.8)
        modelLR.fit(x_train,y_train)    
        scores = modelLR.score(x_test,y_test)
        with open('modelTR_Huruf.pkl', 'wb') as f:
            pickle.dump(modelLR, f)
            elapsed = time.time() - t
        print ("Save Model succeded Time Elapsed = %g"%elapsed)
        print(scores)
    
    
    
    