#include "employe.h"
#include <QSqlQuery>
#include <QtDebug>
#include <QObject>
#include <QSqlQuery>
#include <QSqlError>
#include <QDate>
#include <QTableView>
#include<QMessageBox>
#include "QDateEdit"
#include <QIntValidator>
#include"connection.h"
#include <QScrollBar>
#include <qfiledialog.h>
#include <QtPrintSupport/QPrinter>
#include <QtPrintSupport/QPrintDialog>
#include <QTextDocument>
#include <QTextStream>
#include <QDate>
#include <QComboBox>
#include <QTableView>
#include <QSqlDatabase>
#include <QSqlError>
#include <QSqlQuery>
#include "QZXing.h"
Employe::Employe(QString nom, QString prenom, QString DateN, QString fonction, QString cin, int Num, QString salaire)
{
    // Initialize the member variables with the provided values
    this->nom = nom;
    this->prenom = prenom;
    this->DateN = DateN;
    this->fonction = fonction;
    this->cin = cin ;
    this->Num = Num;
    this->salaire = salaire;
}

bool Employe::ajouter()
{
    QSqlQuery query;
    QString res = QString::number(Num);


    query.prepare("INSERT INTO EMPLOYE(NOM, PRENOM, NUM, FONCTION, CIN, SALAIRE, DATEN) VALUES (:nom, :prenom, :num, :fonction, :cin, :salaire, :DateN)");
    query.bindValue(":nom", nom);
    query.bindValue(":prenom", prenom);
    query.bindValue(":num", res);
    query.bindValue(":fonction", fonction);
    query.bindValue(":cin", cin);
    query.bindValue(":DateN", DateN);
    query.bindValue(":salaire", salaire);

    return query.exec();
}



QString Employe::getnom(){return nom;}
QString Employe::getprenom(){return prenom;}
QString Employe::getDateN(){return DateN;}
QString Employe::getsalaire(){return salaire;}
QString Employe::getfonction(){return fonction;}
QString Employe::getcin (){return cin;}
int Employe::getNum(){return Num;}


void Employe::setnom(QString nom){this->nom=nom;}
void Employe::setprenom(QString prenom){this->prenom=prenom;}
void Employe::setDateN(QString DateN){this->DateN =DateN;}
void Employe::setnsalaire(QString salaire){this->salaire=salaire;}
void Employe::setfonction(QString fonction){this->fonction=fonction;}
void Employe::setcin(QString cin){this->cin=cin;}
void Employe::setNum(int Num){this->Num=Num;}
QSqlQueryModel*Employe::afficher()
{
    QSqlQueryModel* model= new QSqlQueryModel();


        model->setQuery("SELECT * FROM EMPLOYE");

        model->setHeaderData(0, Qt::Horizontal, QObject::tr("NOM"));
        model->setHeaderData(1, Qt::Horizontal, QObject::tr("PRENOM"));
        model->setHeaderData(2, Qt::Horizontal, QObject::tr("SALAIRE"));
        model->setHeaderData(3, Qt::Horizontal, QObject::tr("CIN"));
        model->setHeaderData(4, Qt::Horizontal, QObject::tr("NUM"));
        model->setHeaderData(5, Qt::Horizontal, QObject::tr("FONCTION"));
        model->setHeaderData(6, Qt::Horizontal, QObject::tr("DATEN"));

        return model;

}







bool Employe::supprimer(int id)
{
   QSqlQuery query;
    QString res= QString::number(id);
        query.prepare("DELETE FROM EMPLOYE WHERE ID=:id");
        query.bindValue(":id",res);

   return query.exec();
}
bool Employe::modifier(QString nouveauNom, QString nouveauPrenom, int idd, QString date, QString nouvCin, QString nouvFonction, int num, QString nouvSalaire)
{
    QSqlQuery query;
     QString res= QString::number(idd);
     QString ress= QString::number(num);
    query.prepare("UPDATE EMPLOYE SET NOM = :nouveauNom, PRENOM = :nouveauPrenom, DATEN = :date, CIN = :nouvCin, FONCTION = :nouvFonction, NUM = :num, SALAIRE = :nouvSalaire WHERE ID = :idd");
    query.bindValue(":nouveauNom", nouveauNom);
    query.bindValue(":nouveauPrenom", nouveauPrenom);
    query.bindValue(":date", date); // Utilisez le nom du label correspondant pour la date
    query.bindValue(":nouvCin", nouvCin); // Utilisez le nom du label correspondant pour le cin
    query.bindValue(":nouvFonction", nouvFonction); // Utilisez le nom du label correspondant pour la fonction
    query.bindValue(":num", ress); // Utilisez le nom du label correspondant pour le numéro
    query.bindValue(":nouvSalaire", nouvSalaire); // Utilisez le nom du label correspondant pour le salaire
    query.bindValue(":idd", res);

    return query.exec();
}
QSqlQueryModel* Employe::rechercherParCin(QString cin) {
    QSqlQueryModel* model = new QSqlQueryModel();
    QSqlQuery query;
    query.prepare("SELECT * FROM EMPLOYE WHERE CIN = :cin");
    query.bindValue(":cin", cin);
    if (query.exec()) {
        model->setQuery(query);
    }
    return model;
}
QSqlQueryModel* Employe::trierNomsAZ() {
    QSqlQueryModel* model = new QSqlQueryModel();
    QSqlQuery query("SELECT * FROM EMPLOYE ORDER BY NOM ASC");
    model->setQuery(query);
    return model;
}
QSqlQueryModel* Employe::calculerStatistiquesSalaireMoyenParFonction() {
    QSqlQueryModel* model = new QSqlQueryModel();
    QSqlQuery query("SELECT FONCTION, AVG(SALAIRE) AS SALAIRE_MOYEN FROM EMPLOYE GROUP BY FONCTION");
    model->setQuery(query);
    return model;
}
void Employe::genererqr(QString data)
{

    QString filePath ="C:/Users/21692/Desktop/projet c++/qr.png";
       QImage qr = QZXing::encodeData(data);
       if (!qr.isNull())
       {
              if (qr.save(filePath))
              {
                  qDebug() << "QR code saved to:" << filePath;
              }
              else
              {
                  qDebug() << "Failed to save QR code to file!";
              }
       }
       else
       {
              qDebug() << "Failed to generate QR code!";
       }
}

