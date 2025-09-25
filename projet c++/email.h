#ifndef EMAIL_H
#define EMAIL_H
#include <QString>
#include <QDate>
class mailer
{
public:
    mailer();
    mailer(QString, QString, QString);

    static int sendEmail(QString id,QString tel,QDate DATE,QString heure,QString email);
 private:
    QString destinataire;
    QString object,body;
};

#endif // EMAIL_H
