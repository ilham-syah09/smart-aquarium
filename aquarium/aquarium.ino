#include <Arduino.h>

// Wifi
#include <ESP8266WiFi.h>
#include <ESP8266WiFiMulti.h>
#include <ESP8266HTTPClient.h>

#define USE_SERIAL Serial
ESP8266WiFiMulti WiFiMulti;
WiFiClient client;
HTTPClient http;

//simple timer
#include <SimpleTimer.h>
SimpleTimer firstTimer;
SimpleTimer pakanTimer;

// lcd
#include <LiquidCrystal_I2C.h>
LiquidCrystal_I2C lcd(0x27, 16, 2);

// deklarasi pin Ultrasonik
#define airPinTrigger D8
#define airPinEcho D7

// servo
#include <Servo.h>
Servo servo;
#define pinServo D0

// turbidity
#define pinTurbidity A0
float kekeruhan;

// pump
#define pump D5

boolean flag = false;

// URL WEB IOT
String host = "http://192.168.181.185/smart-aquarium/api";
String urlSimpan = host + "/sensor?kekeruhan=";
String urlGetSetting = host + "/setting";

String respon, jadwalPakan;

void setup() {
  // put your setup code here, to run once:

  lcd.init();
  lcd.backlight();

  Serial.begin(115200);   //Komunikasi baud rate

  USE_SERIAL.begin(115200);
  USE_SERIAL.setDebugOutput(false);

  for(uint8_t t = 4; t > 0; t--) {
      USE_SERIAL.printf("[SETUP] Tunggu %d...\n", t);
      USE_SERIAL.flush();
      delay(1000);
  }

  WiFi.mode(WIFI_STA);
  WiFiMulti.addAP("hp murah", "12345678"); // Sesuaikan SSID dan password ini

  Serial.println();
  
  for (int u = 1; u <= 5; u++)
  {
    if ((WiFiMulti.run() == WL_CONNECTED))
    {
      USE_SERIAL.println("Internet Connected");
      USE_SERIAL.flush();

      lcd.setCursor(6, 0);
      lcd.print("WiFi");
      lcd.setCursor(2, 1);
      lcd.print("CONNECTED!!!");
      delay(1000);
    }
    else
    {
      Serial.println("No Internet Connected");

      lcd.setCursor(6, 0);
      lcd.print("WiFi");
      lcd.setCursor(0, 1);
      lcd.print("NOT CONNECTED");
      delay(1000);
    }
  }

  firstTimer.setInterval(2000);
  pakanTimer.setInterval(1000);

  pinMode(airPinTrigger, OUTPUT);
  pinMode(airPinEcho, INPUT);

  // water pump
  pinMode(pump, OUTPUT);
  digitalWrite(pump, LOW);

  //  servo
  servo.attach(pinServo);
  servo.write(0);

  lcd.setCursor(4, 0);
  lcd.print("SMART");
  lcd.setCursor(5, 1);
  lcd.print("AQUARIUM");

  lcd.clear();
  delay(2000);
}

void loop() {
  //  Inisialisasi variabel untuk pembacaan tinggi pakan
  long duration, jarak, tinggiPakan;
  digitalWrite(airPinTrigger, LOW);
  delayMicroseconds(2);
  digitalWrite(airPinTrigger, HIGH);
  delayMicroseconds(10);
  digitalWrite(airPinTrigger, LOW);
  duration = pulseIn(airPinEcho, HIGH);

  //  Rumus pembacaan jarak tinggi
  jarak = (duration / 2) / 29.1;
  Serial.print("Jarak : ");
  Serial.println(jarak);
  
  Serial.println();

  // jadwal pakan
  jadwal();

  if (firstTimer.isReady()) {                    // Check is ready a second timer
        Serial.println("Called every 3 sec");
        int sensorValue = analogRead(pinTurbidity);
        kekeruhan = 100 - (sensorValue / 10.24);
      
        Serial.print("Kekeruhan Air : ");
        Serial.println(kekeruhan);
        lcd.setCursor(1,0);
        lcd.print("KEKERUHAN AIR");
        lcd.setCursor(3,1);
        lcd.print(kekeruhan);
        lcd.setCursor(10,1);
        lcd.print("NTU");

        firstTimer.reset();                        // Reset a second timer
    }

    if (kekeruhan >= 5.01 && kekeruhan <= 15.00)
    {
      if(jarak <= 5 && jarak <= 10)
      {
        digitalWrite(pump, HIGH);
        Serial.println("Pompa Air Berjalan");
      } else {
        digitalWrite(pump, LOW);
        Serial.println("Pompa Air Berjalan");
      }
      
    }
    else
    {
      digitalWrite(pump, LOW);
      Serial.println("Pompa Air tidak berjalan");
    }

    Serial.println();

    // kirim data sensor
    if ((WiFiMulti.run() == WL_CONNECTED))
    {
      USE_SERIAL.print("[HTTP] Memulai...\n");
      
      http.begin(client, urlSimpan + (String) kekeruhan);
      
      USE_SERIAL.print("[HTTP] Menyimpan data sensor ke database ...\n");
      int httpCode = http.GET();
  
      if(httpCode > 0)
      {
        USE_SERIAL.printf("[HTTP] kode response GET : %d\n", httpCode);
  
        if (httpCode == HTTP_CODE_OK)
        {
          respon = http.getString();
          USE_SERIAL.println("Respon : " + respon);
          delay(200);
        }
      }
      else
      {
        USE_SERIAL.printf("[HTTP] GET data gagal, error: %s\n", http.errorToString(httpCode).c_str());
      }
      http.end();
    }

  Serial.println();
  delay(1000);
}

void jadwal(){
  jadwalPakan = "OFF";

  if (pakanTimer.isReady()) {

    // AMBIL DATA PAKAN
    if ((WiFiMulti.run() == WL_CONNECTED))
    {
      USE_SERIAL.print("[HTTP] Memulai...\n");
      
      http.begin(client, urlGetSetting );
      
      USE_SERIAL.print("[HTTP] Ambil data jadwalPakan di database ...\n");
      int httpCode = http.GET();
  
      if(httpCode > 0)
      {
        USE_SERIAL.printf("[HTTP] kode response GET : %d\n", httpCode);
  
        if (httpCode == HTTP_CODE_OK)
        {
          Serial.println();
          
          respon = http.getString();
  
          jadwalPakan = getValue(respon, '#', 0);
  
          USE_SERIAL.println("jadwalPakan : " + jadwalPakan);
          delay(200);
        }
      }
      else
      {
        USE_SERIAL.printf("[HTTP] GET data gagal, error: %s\n", http.errorToString(httpCode).c_str());
      }
      http.end();
    }

    if (jadwalPakan == "ON") {
      if(flag == false) {
        Serial.println("SERVO ON");
        for(int i=1; i <= 3; i++){
          servo.write(90);
          delay(300);
          servo.write(0);
          delay(100);
        }
        flag = true;
      }
    } else {
      Serial.println("SERVO OFF");
      servo.write(0);

      flag = false;
    }
    pakanTimer.reset();                        // Reset a second timer
  }   

}

String getValue(String data, char separator, int index)
{
  int found = 0;
  int strIndex[] = {0, -1};
  int maxIndex = data.length()-1;
 
  for(int i=0; i <= maxIndex && found <= index; i++){
    if(data.charAt(i) == separator || i == maxIndex){
        found++;
        strIndex[0] = strIndex[1]+1;
        strIndex[1] = (i == maxIndex) ? i+1 : i;
    }
  } 
 
  return found>index ? data.substring(strIndex[0], strIndex[1]) : "";
}
