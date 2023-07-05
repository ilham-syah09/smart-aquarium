#include <Arduino.h>

// Wifi
#include <ESP8266WiFi.h>
#include <ESP8266WiFiMulti.h>
#include <ESP8266HTTPClient.h>

#define USE_SERIAL Serial
ESP8266WiFiMulti WiFiMulti;
WiFiClient client;
HTTPClient http;

// simple timer
#include <SimpleTimer.h>
SimpleTimer timerKuras;

// rtc
#include "RTClib.h"
RTC_DS3231 rtc;
char dataHari[7][12] = {"Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"};
String hari, waktu;
int tanggal, bulan, tahun;
String jam, menit, detik;

// lcd
#include <LiquidCrystal_I2C.h>
LiquidCrystal_I2C lcd(0x27, 16, 2);

// deklarasi pin Ultrasonik
#define airPinTrigger D8
#define airPinEcho D7

// servo
#include <Servo.h>
Servo servo;
#define pinServo D3

// turbidity
#define pinTurbidity A0
float voltage, kekeruhan;

// pump
#define pump D5
#define buzzer D6

#define relay_on LOW
#define relay_off HIGH

boolean flag = false, jadwal1 = false, jadwal2 = false, jadwal3 = false;
;

// URL WEB IOT
String host = "http://192.168.181.185/smart-aquarium/api";
String urlSimpan = host + "/sensor?kekeruhan=";
String urlGetSetting = host + "/setting";

String respon, jadwalPakan;

int tinggiAquarium = 20, tinggiAir = 0;

void setup()
{
  // put your setup code here, to run once:
  Serial.begin(115200); // Komunikasi baud rate
  USE_SERIAL.begin(115200);
  USE_SERIAL.setDebugOutput(false);

  servo.attach(pinServo);
  servo.write(0);

  for (uint8_t t = 4; t > 0; t--)
  {
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

  if (!rtc.begin())
  {
    Serial.println("RTC Tidak Ditemukan");
    Serial.flush();
    abort();
  }

  // Atur Waktu
  rtc.adjust(DateTime(F(__DATE__), F(__TIME__)));

  pinMode(airPinTrigger, OUTPUT);
  pinMode(airPinEcho, INPUT);
  pinMode(buzzer, OUTPUT);

  // water pump
  pinMode(pump, OUTPUT);
  digitalWrite(pump, relay_off);

  lcd.setCursor(4, 0);
  lcd.print("SMART");
  lcd.setCursor(5, 1);
  lcd.print("AQUARIUM");

  lcd.clear();
  delay(500);
}

void loop()
{
  // baca tinggi air
  bacaTinggiAir();

  // jadwal pakan kontrol
  jadwalKontrol();

  // sensor turbidity
  bacaTurbidity();

  // kirim database
  kirimDatabase();

  Serial.println();
  delay(500);
}

void jadwalKontrol()
{
  jadwalPakan = "OFF";

  // AMBIL DATA PAKAN
  if ((WiFiMulti.run() == WL_CONNECTED))
  {
    USE_SERIAL.print("[HTTP] Memulai...\n");

    http.begin(client, urlGetSetting);

    USE_SERIAL.print("[HTTP] Ambil data jadwalPakan di database ...\n");
    int httpCode = http.GET();

    if (httpCode > 0)
    {
      USE_SERIAL.printf("[HTTP] kode response GET : %d\n", httpCode);

      if (httpCode == HTTP_CODE_OK)
      {
        Serial.println();

        respon = http.getString();

        jadwalPakan = getValue(respon, '#', 0);

        USE_SERIAL.println("jadwalPakan : " + jadwalPakan);
        delay(200);

        if (jadwalPakan == "ON")
        {
          if (flag == false)
          {
            Serial.println("SERVO ON");
            handleServo();

            flag = true;
          }
        }
        else
        {
          Serial.println("SERVO OFF");
          servo.write(0);

          flag = false;
        }
      }

      void bacaWaktuRtc()
      {
        DateTime now = rtc.now();
        hari = dataHari[now.dayOfTheWeek()];
        tanggal = now.day(), DEC;
        bulan = now.month(), DEC;
        tahun = now.year(), DEC;
        jam = now.hour(), DEC;
        menit = now.minute(), DEC;
        detik = now.second(), DEC;

        if (jam.length() == 1)
        {
          jam = "0" + jam;
        }
        if (menit.length() == 1)
        {
          menit = "0" + menit;
        }
        if (detik.length() == 1)
        {
          detik = "0" + detik;
        }

        waktu = jam + ":" + menit;

        Serial.println(String() + hari + ", " + tanggal + "-" + bulan + "-" + tahun);
        Serial.println(waktu);
        Serial.println();

        // jadwal1
        if (waktu == "07:10")
        {
          if (jadwal1 == false)
          {
            handleServo();
            Serial.println("SUKSES");
            jadwal1 = true;
          }
        }
        else
        {
          jadwal1 = false;
        }

        // jadwal2
        if (waktu == "12:10")
        {
          if (jadwal2 == false)
          {
            handleServo();
            Serial.println("SUKSES");
            jadwal2 = true;
          }
        }
        else
        {
          jadwal2 = false;
        }

        // jadwal3
        if (waktu == "16:10")
        {
          if (jadwal3 == false)
          {
            handleServo();
            Serial.println("SUKSES");
            jadwal3 = true;
          }
        }
        else
        {
          jadwal3 = false;
        }

        delay(500);
      }

      void handleServo()
      {
        Serial.println("Servo Open");

        for (int i = 1; i <= 3; i++)
        {
          digitalWrite(buzzer, HIGH);
          servo.write(90);
          delay(300);
          servo.write(0);
          delay(300);
        }
      }

      void bacaTinggiAir()
      {
        //  Inisialisasi variabel untuk pembacaan tinggi pakan
        long duration, jarak;
        digitalWrite(airPinTrigger, LOW);
        delayMicroseconds(2);
        digitalWrite(airPinTrigger, HIGH);
        delayMicroseconds(10);
        digitalWrite(airPinTrigger, LOW);
        duration = pulseIn(airPinEcho, HIGH);

        //  Rumus pembacaan jarak tinggi
        jarak = (duration / 2) / 29.1;

        tinggiAir = tinggiAquarium - jarak;

        if (tinggiAir < 0)
        {
          tinggiAir = 0;
        }

        Serial.print("Tinggi Air : ");
        Serial.println(tinggiAir);

        lcd.clear();

        lcd.setCursor(0, 0);
        lcd.print("TINGGI AIR : ");
        lcd.setCursor(13, 0);
        lcd.print(tinggiAir);

        Serial.println();

        delay(1000);
      }

      void bacaTurbidity()
      {
        int sensorValue = analogRead(pinTurbidity);
        kekeruhan = 100 - (sensorValue / 10.24);

        Serial.print("Kekeruhan Air : ");
        Serial.print(kekeruhan);
        Serial.println(" NTU");

        lcd.clear();

        lcd.setCursor(1, 0);
        lcd.print("KEKERUHAN AIR");
        lcd.setCursor(3, 1);
        lcd.print(kekeruhan);
        lcd.setCursor(10, 1);
        lcd.print("NTU");

        if (kekeruhan >= 5.01 && kekeruhan <= 15.00)
        {
          timerKuras.setInterval(10000);

          if (timerKuras.isReady())
          {
            digitalWrite(pump, relay_off);
            Serial.println("Pompa Air Berhenti");

            timerKuras.reset();
          }
          else
          {
            digitalWrite(pump, relay_on);
            Serial.println("Pompa Air Berjalan");
          }
        }
        else
        {
          digitalWrite(pump, relay_off);
          Serial.println("Pompa Air Berhenti");
        }

        Serial.println();

        delay(1000);
      }

      void kirimDatabase()
      {
        // kirim data sensor
        if ((WiFiMulti.run() == WL_CONNECTED))
        {
          USE_SERIAL.print("[HTTP] Memulai...\n");

          http.begin(client, urlSimpan + (String)kekeruhan + "&tinggiAir=" + (String)tinggiAir);

          USE_SERIAL.print("[HTTP] Menyimpan data sensor ke database ...\n");
          int httpCode = http.GET();

          if (httpCode > 0)
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

        delay(500);
      }

      String getValue(String data, char separator, int index)
      {
        int found = 0;
        int strIndex[] = {0, -1};
        int maxIndex = data.length() - 1;

        for (int i = 0; i <= maxIndex && found <= index; i++)
        {
          if (data.charAt(i) == separator || i == maxIndex)
          {
            found++;
            strIndex[0] = strIndex[1] + 1;
            strIndex[1] = (i == maxIndex) ? i + 1 : i;
          }
        }

        return found > index ? data.substring(strIndex[0], strIndex[1]) : "";
      }
