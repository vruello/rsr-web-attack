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
import bcrypt

flag = '48294e0ba97e1ff2b23ba6357c1b9880a3f600459ef89cd58013571b47e58797'
salt = "$2b$12$R0xZ9nRdaWRNmfBMnaaTSO"

bcrypt.gensalt()
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
    for i in range(1, len(wallet)):
        total += wallet[i] * currencies[i - 1][2]
    return round(total, 5)


def unicodeToString(txt):
    return txt if isinstance(txt, str) else unicodedata.normalize('NFKD', txt).encode('ascii', 'ignore')


def crypte(txt):
    return bcrypt.hashpw(txt, salt)


def check_challenge(receiver, sender):
    global flag
    if receiver == '3MqfLxPrTUAHkAt1HZArfcCe8DCLhbRtTZ' and sender == '3MVLdLUTDx6qQHd9wwTnr5it1aoqwzMnjR':
        return flag
    return None
