#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <Wire.h>
#include <LiquidCrystal_I2C.h>
#include <SPI.h>
#include <MFRC522.h>
#include <ArduinoJson.h>

#define SDA_PIN D8  // RFID SS pin
#define RST_PIN D0  // RFID Reset pin
#define buzzer D3

LiquidCrystal_I2C lcd(0x27, 16, 2); // LCD I2C address (change if needed)
MFRC522 rfid(SDA_PIN, RST_PIN);

// Wi-Fi credentials
const char* ssid = "Herbez";
const char* password = "Hpass@123";

WiFiClient client;

void setup() {
  Serial.begin(115200);

  // Initialize LCD
  Wire.begin(D2, D1);
  lcd.init();
  lcd.backlight();
  lcd.setCursor(0, 0);
  lcd.print("Tap The Card...");

  // Initialize RFID
  SPI.begin();
  rfid.PCD_Init();
  Serial.println("RFID Ready");

  // Initialize Buzzer
  pinMode(buzzer, OUTPUT);
  digitalWrite(buzzer, LOW);

  // Connect to Wi-Fi
  WiFi.begin(ssid, password);
  Serial.print("Connecting to Wi-Fi");

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("\nSuccessfully connected to: " + String(ssid));
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());
}

void loop() {
  if (rfid.PICC_IsNewCardPresent() && rfid.PICC_ReadCardSerial()) {
    Serial.print("Card detected! ID: ");

    // Convert UID to string
    String cardID = "";
    for (byte i = 0; i < rfid.uid.size; i++) {
      cardID += String(rfid.uid.uidByte[i], HEX);
    }

    Serial.println(cardID);

    // Activate buzzer for 1 second
    digitalWrite(buzzer, HIGH);
    delay(500);
    digitalWrite(buzzer, LOW);

    // Send card ID to server and get response
    String response = sendCardDataToServer(cardID);
    displayResponse(response);

    // Halt RFID card
    rfid.PICC_HaltA();
    rfid.PCD_StopCrypto1();
    
    // **Delay before resetting LCD**
    delay(3000); // Give 5 seconds to view the data

    // Reset LCD
    lcd.clear();
    lcd.setCursor(0, 0);
    lcd.print("Tap The Card...");
  }
}

String sendCardDataToServer(String UIDresultSend) {
  if (WiFi.status() == WL_CONNECTED) {
    HTTPClient http;
    String response = "";
    int httpResponseCode;  // Declared here to avoid scope errors
    String postData = "UIDresult=" + UIDresultSend;

    // First request: send to getUID.php
    http.begin(client, "http://192.168.152.183/Hillel/getUID.php");
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");

    httpResponseCode = http.POST(postData);
    Serial.print("Response (getUID.php): ");
    Serial.println(httpResponseCode);
    http.end();

        // Second request: send to check_card.php.php
    http.begin(client, "http://192.168.152.183/Hillel/check_card.php");
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");

    httpResponseCode = http.POST(postData);
    Serial.print("Response (check_card.php): ");
    Serial.println(httpResponseCode);
    http.end();

    // Third request: send to fetch_card_id.php
    http.begin(client, "http://192.168.152.183/Hillel/fetch_card_id.php?id=" + UIDresultSend);
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");

    httpResponseCode = http.POST(postData);
    Serial.print("Response (fetch_card_id.php): ");
    Serial.println(httpResponseCode);

    if (httpResponseCode > 0) {
      response = http.getString();  // Get response data
    }

    http.end();
    return response;
  } else {
    Serial.println("WiFi not connected");
    return "";
  }
}


void displayResponse(String response) {
  DynamicJsonDocument doc(256);
  DeserializationError error = deserializeJson(doc, response);

 if (!error) {
    String name = doc["name"].as<String>();
    int payment_status = doc["payment_status"].as<int>();

    lcd.clear();
    lcd.setCursor(0, 0);
    lcd.print("Name: " + name);

    if (payment_status == 1 ) {
      lcd.setCursor(0, 1);
      lcd.print("Allowed");
    } else if(payment_status == 2 || payment_status ==3){
      lcd.setCursor(0, 1);
      lcd.print("Not Allowed");
    }  else {
      lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("Not Registered");
    }
  } 

}
