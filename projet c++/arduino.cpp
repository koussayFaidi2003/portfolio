// arduino.cpp
#include "arduino.h"

arduino::arduino() {
    // Initialize other variables if necessary
}

int arduino::connect_arduino() {
    foreach(const QSerialPortInfo &serial_port_info, QSerialPortInfo::availablePorts()) {
        if (serial_port_info.hasVendorIdentifier() && serial_port_info.hasProductIdentifier()) {
            if (serial_port_info.vendorIdentifier() == arduino_uno_vendor_id && serial_port_info.productIdentifier() == arduino_uno_product_id) {
                arduino_is_available = true;
                arduino_port_name = serial_port_info.portName();
            }
        }
    }
    qDebug() << "arduino_port_name is :" << arduino_port_name;
    if (arduino_is_available) {
        serial.setPortName(arduino_port_name); // Changed to setPortName instead of ->setPortName
        if (serial.open(QSerialPort::ReadWrite)) {
            serial.setBaudRate(QSerialPort::Baud9600);
            serial.setDataBits(QSerialPort::Data8);
            serial.setParity(QSerialPort::NoParity);
            serial.setStopBits(QSerialPort::OneStop);
            serial.setFlowControl(QSerialPort::NoFlowControl);
            return 0;
        }
        return 1;
    }
    return 1; // Added to handle case when Arduino is not available
}
int arduino::close_arduino()
{
    if(serial.isOpen())
    {
        serial.close();
        return 0;}
    return 1;
}
QByteArray arduino::read_from_arduino()
{
    if (serial.isReadable())
    {
        data = serial.readAll();
        return data;
    }
    return QByteArray(); // Return a default-constructed QByteArray if the condition is not met
}

int arduino::write_to_arduino(QByteArray d)
{
    if (serial.isWritable())
    {
        serial.write(d);
        return 0; // Return 0 to indicate successful write
    }
    else
    {
        qDebug() << "Couldn't write to serial";
        return 1; // Return 1 to indicate failure to write
    }
}
QSerialPort& arduino::getserial() {
    return serial;
}
