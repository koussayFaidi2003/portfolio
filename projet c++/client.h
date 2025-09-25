#ifndef CLIENT_H
#define CLIENT_H
#include <QString>
#include <QSqlQuery>
#include <QSqlQueryModel>
#include <QDate>
#include <QTime>
#include<QSqlQuery>
#include<QList>

struct ClientInfo {
    QString ID;

    QString TEL;
    QDate DAT;
    QString HEURE;
    QString email;
};

class Client
{
public:
    void setID(QString n );
    void setDAT(QDate n );
    void setTEL(QString n );
    void setHEURE(QString n );
    void setemail(QString n );
    QString get_ID();
      QDate get_DAT();
        QString get_TEL();
          QString get_HEURE();
            QString get_email();

          Client(){}
          Client (QString,QDate,QString,QString,QString);
    bool createconnect();
    bool Ajouter();

    QSqlQueryModel * afficher();
    bool supprimer(QString ID);
    bool chercher(QString ID);
    bool modifier();
    bool reset();
QSqlQueryModel* trierParIdent();
  Client rechercherclientParIdentifiant(QString ID);
  QString fetchClientInfoFromDatabase(QString id);

  QString getAllClients(QString id);

private:
    QString ID, TEL, HEURE;
    QDate DAT;
QString IDString;
QString email;

};

#endif // CLIENT_H

