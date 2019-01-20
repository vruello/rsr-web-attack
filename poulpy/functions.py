#!/usr/bin/python
# -*- coding: utf-8 -*-
__author__ = "Camille El-Habr"
__maintainer__ = "Camille El-Habr"
__email__ = "camille.el-habr@enseirb-matmeca.fr"
__credits__ = ["Camille El-Habr"]
__copyright__ = "Copyright 2019 - Poulpy RSR"
__version__ = "1.0"
__status__ = "Prototype"
__description__ = 'Poulpy main functions'

import random
import unicodedata

flag = '48294e0ba97e1ff2b23ba6357c1b9880a3f600459ef89cd58013571b47e58797'

def random_number():
    """ """
    return random.randrange(100000, 999999)

def find_password(liste, login):
    """ """
    for user in liste:
        if user[0] == login:
            return user[1]
    return None

def total_heritage(currencies, wallet):
    total = 0
    for i in range(1,len(wallet)):
        total += wallet[i] * currencies[i-1][2]
    return round(total, 5)

def unicodeToString(txt):
    return unicodedata.normalize('NFKD', txt).encode('ascii','ignore')

def check_challenge(receiver, sender):
    global flag
    print(flag)
    if receiver == '8954c0fad06520bbdaa53439b15898c4' and sender == '0b14ec1baba4b4c1b06fb06e9c0d77d7':
        return flag
    return None