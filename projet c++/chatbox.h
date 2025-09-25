// chatbox.h
#ifndef CHATBOX_H
#define CHATBOX_H

#include <QWidget>
#include <QVBoxLayout>
#include <QTextEdit>
#include <QLineEdit>
#include <QPushButton>

class ChatBox : public QWidget
{
    Q_OBJECT

public:
    explicit ChatBox(QWidget *parent = nullptr);

private slots:
    void sendMessage();

private:
    QVBoxLayout *mainLayout;
    QTextEdit *chatDisplay;
    QLineEdit *messageInput;
    QPushButton *sendButton;
};

#endif // CHATBOX_H
