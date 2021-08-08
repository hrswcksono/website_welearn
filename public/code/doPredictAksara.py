# -*- coding: utf-8 -*-
"""
Created on Fri May  7 13:44:28 2021

@author: asus
"""

import pickle,sys
from keras.applications.mobilenet import MobileNet
DIM=224
IMG_DIM = (DIM, DIM)
input_shape = (DIM, DIM, 3)
import keras
from keras.models import Model
import os,cv2
import time
import numpy as np
import operator

def loadModel(nmModel):
    f = open(nmModel, 'rb')
    model = pickle.load(f)
    return model

def createMobileNet():
    mobileNet =  MobileNet(include_top=False, weights='imagenet', 
                                     input_shape=input_shape)

    output    = mobileNet.layers[-1].output
    output    = keras.layers.Flatten()(output)
    ModelmobileNet = Model(inputs=mobileNet.input, outputs=output)# base_model.get_layer('custom').output)

    ModelmobileNet.trainable = False
    for layer in ModelmobileNet.layers:
        layer.trainable = False
    return ModelmobileNet

def prediksiImg(nmFile,model):
    t = time.time()
    img = cv2.imread(nmFile)
    if img is None:
        return t,"REJECTED, not valid file , cant be predict"
    
    img = cv2.resize(img, IMG_DIM)
    img=img/255
    img=img.reshape(1,img.shape[0],img.shape[1],img.shape[2])
    ModelmobileNet = createMobileNet()

    ftr_np = ModelmobileNet.predict(img, verbose=0)
    
    predicted_proba = model.predict_proba(ftr_np)
    res = {}
    prob = -1
    for i in range(len(model.classes_)):
        res[model.classes_[i]] = predicted_proba[0][i]
    res = sorted(res.items(), key=operator.itemgetter(1))
    res.reverse()
    
    rank = 0
    prev_val = 0
    aksara = ''
    for key, val in res:
        if val >= prev_val:
            rank += 1
            prob = val
            aksara = key
        prev_val = val
        # rank += 1
        # if key == huruf:
        #     prob = val
        #     break
    score = round(prob*100,2)
    nmFile = nmFile.replace('/','\\')
    
    if prob == -1:
        if nmFile.find('X__') > 0:
             nmFileNew = nmFile.replace('X__','NR__')
             os.system('move %s %s'%(nmFile,nmFileNew))
        return t,"REJECTED,ERR: image data of " + aksara + " is currently not registered, no photos have been trained"


    if rank <= 5 and score > 60:
        result = "ACCEPTED,"
        if nmFile.find('X__')>0:
             nmFileNew = nmFile.replace('X__','A__')
        else:
             nmFileNew = nmFile.replace('R__','A__')
        os.system('move %s %s 2&> /dev/null'%(nmFile,nmFileNew))


    else:
        result = "REJECTED,"
        if nmFile.find('X__') > 0:
             nmFileNew = nmFile.replace('X__','R__')
             os.system('move %s %s'%(nmFile,nmFileNew))

    # return t,"%s %s mobileNet score %g  rank %g" %(result,huruf,score,rank)
    return t,"%s" %aksara

if __name__ == '__main__':
    #t = time.time()
    # model=loadModel('modelTR_Huruf.pkl')
    filemodel = sys.argv[2]
    nmFile = sys.argv[1]
    model=loadModel(filemodel)
    # huruf = 'A'
    # nmFile = 'F:\\KULIAH ITS PUTRI\\SEMESTER 8 (2021)\\TUGAS AKHIR\\TA Putri\\predictHuruf\\hsf_0_00011.png'
    
    t,r=prediksiImg(nmFile,model)
    elapsed = time.time() - t
    print("%s"%r)