#-------------------------------------------------
#
# Project created by QtCreator 2018-10-26T21:45:23
#
#-------------------------------------------------

QT       += core gui sql
QT       += core gui charts
QT       += charts
QT       += multimedia
QT       += printsupport
QT       += axcontainer
QT       += network
QT       += serialport
greaterThan(QT_MAJOR_VERSION, 4): QT += widgets

TARGET = Atelier_Connexion
TEMPLATE = app
include(C:/Users/21692/Downloads/qzxingmasterr/src/QZXing.pri)
# The following define makes your compiler emit warnings if you use
# any feature of Qt which has been marked as deprecated (the exact warnings
# depend on your compiler). Please consult the documentation of the
# deprecated API in order to know how to port your code away from it.
DEFINES += QT_DEPRECATED_WARNINGS

# You can also make your code fail to compile if you use deprecated APIs.
# In order to do so, uncomment the following line.
# You can also select to disable deprecated APIs only up to a certain version of Qt.
#DEFINES += QT_DISABLE_DEPRECATED_BEFORE=0x060000    # disables all the APIs deprecated before Qt 6.0.0

CONFIG += c++11

SOURCES += \
    arduino.cpp \
    chatbox.cpp \
    clickablelable.cpp \
    client.cpp \
    email.cpp \
    employe.cpp \
    equipement.cpp \
        main.cpp \
        mainwindow.cpp \
    connection.cpp \
    modifier.cpp \
    notify.cpp \
    notifymanager.cpp \
    patient.cpp \
    reclamation.cpp \
    salle.cpp

HEADERS += \
    arduino.h \
    chatbox.h \
    clickablelable.h \
    client.h \
    email.h \
    employe.h \
    equipement.h \
        mainwindow.h \
    connection.h \
    modifier.h \
    notify.h \
    notifymanager.h \
    patient.h \
    reclamation.h \
    salle.h

FORMS += \
        mainwindow.ui \
        modifier.ui

# Default rules for deployment.
qnx: target.path = /tmp/$${TARGET}/bin
else: unix:!android: target.path = /opt/$${TARGET}/bin
!isEmpty(target.path): INSTALLS += target

RESOURCES += \
    fddf.qrc \
    jjj.qrc \
    resou.qrc
