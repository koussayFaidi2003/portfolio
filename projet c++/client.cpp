#include "client.h"
#include <QSqlDatabase>
#include<QMessageBox>
#include <QDate>
#include "connection.h"
#include<QDebug>
#include <QSqlError>
#include<QSqlError>
#include <QtSql>
#include <QtWidgets>
#include <QDesktopServices>
#include <QUrl>
#include <QUrlQuery>
#include <QDesktopServices>
#include <QUrl>



void Client::setID(QString n){ID=n;}
void Client::setDAT(QDate n) {
    DAT = n;
}



void Client::setTEL(QString n){TEL=n;}
void Client::setHEURE(QString n){HEURE=n;}


QString Client:: get_ID(){return ID;}
QDate Client:: get_DAT(){return DAT;}
QString Client:: get_TEL(){return TEL;}
QString Client:: get_HEURE(){return HEURE;}

connection c;
bool test = c.createconnection();
Client::Client(QString ID, QDate DAT,QString TEL ,QString HEURE ,QString email)
{
    this->ID=ID;
    this->DAT=DAT;
    this->TEL=TEL;
    this->HEURE=HEURE;
 this->email=email;

}

bool Client::Ajouter()
{
    QSqlQuery query;
    query.prepare ("INSERT INTO CLIENT (ID, DAT, TEL, HEURE,email) "
                  "VALUES (:ID, :DAT, :TEL, :HEURE,:email)");

    // Assurez-vous que les valeurs id, date, Tel et heure sont correctement initialisées
    // avant d'appeler cette fonction.

    query.bindValue(":ID", ID);       // Assurez-vous que id est une variable membre de la classe Client
    query.bindValue(":DAT", DAT);   // Assurez-vous que date est une variable membre de la classe Client
    query.bindValue(":TEL", TEL);     // Assurez-vous que Tel est une variable membre de la classe Client
    query.bindValue(":HEURE", HEURE); // Assurez-vous que heure est une variable membre de la classe Client
 query.bindValue(":email", email); // Assurez-vous que heure est une variable membre de la classe Client
    // Exécutez la requête et retournez true si elle s'est exécutée avec succès, sinon retournez false
    return query.exec();
}







bool Client::supprimer(QString ID)
{
    QSqlQuery query;
        query.prepare("DELETE  from CLIENT where ID=:ID");
        query.bindValue(0, ID);
    return query.exec();
}
bool Client::chercher(QString ID)
{
    QSqlQuery query;
    query.prepare("SELECT COUNT(*) FROM Client WHERE ID = :ID;");
    query.bindValue(":ID", ID);

    if (query.exec() && query.next()) {
        int count = query.value(0).toInt();
        if (count > 0) {
            qDebug() << "Record with ID:" << ID << "exists in the database.";
            return true;
        } else {
            qDebug() << "Record with ID:" << ID << "does not exist in the database.";
            return false;
        }
    } else {
        qDebug() << "Error checking database:" << query.lastError().text();
        return false;
    }
}
bool Client::modifier()
{

QSqlQuery query;
query.prepare("SELECT * FROM Client WHERE ID = :ID");
    query.bindValue(":ID", ID);
    query.exec();

    if (query.next()) {
        int count = query.value(0).toInt();
        if (count > 0) {
            // If the patient already exists, update the number of occurrences
            query.prepare("UPDATE Client SET TEL = :TEL, DAT = :DAT, HEURE = :HEURE, EMAIL= :EMAIL WHERE ID = :ID");
            query.bindValue(":ID", ID);
            query.bindValue(":DAT", DAT);
            query.bindValue(":TEL", TEL);
            query.bindValue(":HEURE", HEURE);
      query.bindValue(":email", email);
            if (!query.exec()) {
                return false;
            }
            return true;
        }
    }
    return query.exec();
}
bool Client::reset()
{
   QSqlQuery query;
        query.prepare("delete Client");
        query.bindValue(0, ID);
     return query.exec();
}

QSqlQueryModel* Client::trierParIdent()
{
    QSqlQueryModel* model = new QSqlQueryModel();
    model->setQuery("SELECT * FROM Client ORDER BY ID ASC");
    model->setHeaderData(0, Qt::Horizontal, QObject::tr("ID"));
    model->setHeaderData(1, Qt::Horizontal, QObject::tr("DAT"));
    model->setHeaderData(2, Qt::Horizontal, QObject::tr("TEL"));
    model->setHeaderData(3, Qt::Horizontal, QObject::tr("HEURE"));
    model->setHeaderData(4, Qt::Horizontal, QObject::tr("email"));
    return model;
}
Client  Client::rechercherclientParIdentifiant(QString ID)
{
    // Créez un objet employee vide pour stocker les informations de l'employé trouvé
    Client emp;

    // Connexion à la base de données
    QSqlDatabase db = QSqlDatabase::database();  // Assurez-vous que vous avez une connexion valide à votre base de données

    if (db.isValid() && db.isOpen()) {
        QSqlQuery query;

        // Exécutez une requête SQL pour rechercher le client par identifiant
        query.prepare("SELECT * FROM Client WHERE ID = :ID");
        query.bindValue(":ID", ID);

        if (query.exec()) {
            if (query.next()) {
                // LE CLIENT a été trouvé, remplissez l'objet employee avec les données de la base de données

                emp.setID(query.value("ID").toString());
                emp.setTEL(query.value("TEL").toString());
                emp.setHEURE(query.value("HEURE").toString());
                emp.setDAT(query.value("D").toDate());
               // emp.setemail(query.value("email").toString());

                qDebug() << "CLIENT existant.";
            } else {
                qDebug() << "CLIENT introuvable.";
            }
        } else {
            qDebug() << "Erreur SQL : " << query.lastError().text();
        }
    } else {
        qDebug() << "Connexion à la base de données invalide ou fermée.";
    }

    return emp;
}
QString Client::fetchClientInfoFromDatabase(QString id) {
    QSqlQuery query;
    query.prepare("SELECT ID, TEL, DAT, HEURE FROM Client WHERE id=:id ");
    query.bindValue(":id", id);

    if (!query.exec()) {
        qDebug() << "Query error:" << query.lastError().text();
        return QString();
    }

    if (query.next()) {
        QString ID = query.value(0).toString();
        QString TEL = query.value(1).toString();
        QDate DAT = query.value(2).toDate();
        QString HEURE = query.value(3).toString();
           QString email = query.value(4).toString();
        QString formattedInfo = QString("ID: %1\nTEL: %2\nDAT: %3\nHEURE: %4")
                                .arg(ID)
                                .arg(TEL)
                                .arg(DAT.toString("yyyy-MM-dd"))
                                .arg(HEURE)
                                .arg(email);

        return formattedInfo;
    } else {
        qDebug() << "No data found for ID:" << id;
        return QString();
    }
}



QString Client::getAllClients(QString id) {
    QSqlQuery query;
    query.prepare("SELECT ID, TEL, DAT, HEURE,email FROM Client WHERE ID=:ID ");
    query.bindValue(":id", ID);

    if (!query.exec()) {
        qDebug() << "Query error:" << query.lastError().text();
        return QString();
    }

    if (query.next()) {
        QString ID = query.value(0).toString();
        QString TEL = query.value(1).toString();
        QDate DAT = query.value(2).toDate();
        QString HEURE = query.value(3).toString();
        QString email= query.value(4).toString();

        QString formattedInfo = QString("ID: %1\nTEL: %2\nDAT: %3\nHEURE: %4")
                                .arg(ID)
                                .arg(TEL)
                                .arg(DAT.toString("yyyy-MM-dd"))
                                .arg(HEURE);

        return formattedInfo;
    } else {
        qDebug() << "No data found for ID:" << id;
        return QString();
    }
}


QSqlQueryModel *Client::afficher()
{
  QSqlQueryModel *model=new QSqlQueryModel();
        model->setQuery("SELECT * FROM Client ");
        model->setHeaderData(0, Qt::Horizontal, QObject::tr("ID"));
        model->setHeaderData(1, Qt::Horizontal, QObject::tr("DAT"));
        model->setHeaderData(2, Qt::Horizontal, QObject::tr("HEURE"));
        model->setHeaderData(3, Qt::Horizontal, QObject::tr("TEL"));


        model->setHeaderData(4, Qt::Horizontal, QObject::tr("EMAIL"));
               return model;
}

