#ifndef PATIENT_H
#define PATIENT_H
#include <QString>
#include <QDate>
#include <QSqlQuery>
#include <QSqlQueryModel>
#include <QStandardItemModel>
#include <QtCharts>
#include <QtCharts/QChartView>
#include <QtCharts/QPieSeries>
#include <QtCharts/QPieSlice>
#include <QtCore/QDebug>
QT_CHARTS_USE_NAMESPACE

using namespace QtCharts;

class Patient
{
public:
    Patient(){}
    Patient(QString,QString,int,QDate,QString,QString);
private:
    QString nom,prenom,adress,typeRed;
    int num,id;
    QDate dateN;
public:
    //setters
    void setNom(QString n);
    void setPrenom(QString n);
    void setAdress(QString n);
    void setTypeRed(QString n);
    void setNum(int n);
    void setDate(QDate n);
    void setID(int n);

    //getters
    QString getNom();
    QString getPrenom();
    QString getAdress();
    QString getTypeRed();
    int getNum();
    int getId();
    QDate getDate();

    //CRUD
    bool ajouter();
    QStandardItemModel * afficher();
    bool supprimer(QStandardItemModel*);
    bool modifier(QStandardItemModel*);
    QChartView * afficher_Stats();
    void displayChartView();
    void displayChartViewTop3Customers();
    QChartView * afficher_Top3_Customers();
};

#endif // PATIENT_H
