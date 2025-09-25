// chatbox.cpp
#include "chatbox.h"

ChatBox::ChatBox(QWidget *parent) : QWidget(parent)
{
    // Layout principal
    mainLayout = new QVBoxLayout(this);

    // Zone de texte pour afficher les messages
    chatDisplay = new QTextEdit(this);
    chatDisplay->setReadOnly(true);

    // Champ de saisie pour le message
    messageInput = new QLineEdit(this);

    // Bouton d'envoi
    sendButton = new QPushButton("Envoyer", this);
    connect(sendButton, &QPushButton::clicked, this, &ChatBox::sendMessage);

    // Ajout des widgets au layout principal
    mainLayout->addWidget(chatDisplay);
    mainLayout->addWidget(messageInput);
    mainLayout->addWidget(sendButton);
}

void ChatBox::sendMessage()
{
    // Récupérer le message depuis le champ de saisie
    QString message = messageInput->text();

    // Ajouter le message à la zone de texte avec une nouvelle ligne
    chatDisplay->append(message);

    // Effacer le champ de saisie après l'envoi du message
    messageInput->clear();
}
