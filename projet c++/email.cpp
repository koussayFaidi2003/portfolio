#include "email.h"
#include <QtNetwork>
#include <QDebug>
mailer::mailer()
{

}

int mailer::sendEmail(QString id,QString tel,QDate DATE,QString heure,QString email)
{


        // SMTP server information
        QString smtpServer = "smtp.gmail.com";
        int smtpPort = 465;  // Adjust this based on your SMTP server configuration
        QString username = "essghir.malek@esprit.tn";
        QString password = "fkfz qrsg jgxv kvrr";
        //opuc ifgh tjle ciag
        // Sender and recipient information
        QString from = "essghir.malek@esprit.tn";
        QString to =email;
        QString subject = id;

        QString body ="tel:" + tel + " Date : " + DATE.toString("yyyy-MM-dd") + "  heure :" +heure ;

        // Create a TCP socket
        QSslSocket socket;

        // Connect to the SMTP server
        socket.connectToHostEncrypted(smtpServer, smtpPort);
        if (!socket.waitForConnected()) {

            return -1;
        }

        // Wait for the greeting from the server
        if (!socket.waitForReadyRead()) {

            return -1;
        }

        qDebug() << "Connected to the server.";

        // Send the HELO command
        socket.write("HELO localhost\r\n");
        socket.waitForBytesWritten();

        // Read the response from the server
        if (!socket.waitForReadyRead()) {

            return -1;
        }

        // Send the authentication information
        socket.write("AUTH LOGIN\r\n");
        socket.waitForBytesWritten();

        if (!socket.waitForReadyRead()) {

            return -1;
        }

        // Send the username
        socket.write(QByteArray().append(username.toUtf8()).toBase64() + "\r\n");
        socket.waitForBytesWritten();

        if (!socket.waitForReadyRead()) {

            return -1;
        }

        // Send the password
        socket.write(QByteArray().append(password.toUtf8()).toBase64() + "\r\n");
        socket.waitForBytesWritten();

        if (!socket.waitForReadyRead()) {

            return -1;
        }

        // Send the MAIL FROM command
        socket.write("MAIL FROM:<" + from.toUtf8() + ">\r\n");
        socket.waitForBytesWritten();

        if (!socket.waitForReadyRead()) {

            return -1;
        }

        // Send the RCPT TO command
        socket.write("RCPT TO:<" + to.toUtf8() + ">\r\n");
        socket.waitForBytesWritten();

        if (!socket.waitForReadyRead()) {

            return -1;
        }

        // Send the DATA command
        socket.write("DATA\r\n");
        socket.waitForBytesWritten();

        if (!socket.waitForReadyRead()) {

            return -1;
        }

        // Send the email content
        socket.write("From: " + from.toUtf8() + "\r\n");
        socket.write("To: " + to.toUtf8() + "\r\n");
        socket.write("Subject: " + subject.toUtf8() + "\r\n");
        socket.write("\r\n");  // Empty line before the body
        socket.write(body.toUtf8() + "\r\n");
        socket.write(".\r\n");  // End of email content
        socket.waitForBytesWritten();

        if (!socket.waitForReadyRead()) {

            return -1;
        }

        // Send the QUIT command
        socket.write("QUIT\r\n");
        socket.waitForBytesWritten();

        if (!socket.waitForReadyRead()) {

            return -1;
        }

        qDebug() << "Email sent successfully.";

        // Close the socket
        socket.close();
}

