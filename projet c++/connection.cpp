#include "connection.h"
#include <QDebug>
#include <QSqlError>
#include <QSqlQuery>

connection::connection()
{
    // Constructor body is empty
}

bool connection::createconnection()
{
    db = QSqlDatabase::addDatabase("QODBC");
    db.setDatabaseName("test-bd");
    db.setUserName("koussay");
    db.setPassword("koussay");
    if (db.open())
    {
        qDebug() << "Connection to the database successful";
        return true;
    }
    else
    {
        QSqlError lastError = db.lastError();
        qDebug() << "Failed to connect to the database. Error: " << lastError.text();
        return false;
    }
}


void connection::closeconnection()
{
    db.close();
}
