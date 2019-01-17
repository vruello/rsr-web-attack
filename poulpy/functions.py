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