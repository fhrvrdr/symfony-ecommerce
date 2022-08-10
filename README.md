# Patika - Enuygun PHP Bootcamp Bitirme Projesi

Patika.dev - Enuygun PHP Developer Bootcamp bitirme projesi. Bu proje bir e-ticaret projesidir.

## Dokümantasyon

* [Kullanılan Teknolojiler](#)
* [Proje Gereksinimleri](#)
* [Proje Çözümleri](#)
* [Sistemdeki Roller](#)
* [Kurulum](#kurulum)
* [Konfigürasyon](#)

## Kullanılan Teknolojiler

* Symfony (5.4)
* PHP (8.1)
* EasyAdmin Bundle
* MySQL (8.0)
* Docker

## Proje Gereksinimleri

* Admin arayüzü olacak ve bu arayüze sadece ROLE_ADMIN yetkisi olan kişi erişim
  sağlayabilecek.
* Kategori,ürün ekleme listeleme ve silme işlemleri gerçekleştirilebilecek.
* Kategori derinliği "n" seviyeye kadar inebilecek.
* Ürünler bir veya birden fazla kategoriye bağlanabilecek.
* Sipariş görüntüleme ve onaylama işlemleri gerçekleştirilecek.
* Kullanıcı arayüzünde kayıt olan kişi sisteme giriş yaptıktan sonra listelenen
  ürünlerden kaç adet eklemek istendiğini ekleme aşamasında belirtip sepetine ürün
  ekleyebilecek
* Kullanıcı eklediği ürünleri sepetim sayfasında görüntüleyebilecek.
* Sepetteki en düşük tutarlı 2. ürüne 50% indirim uygulanacak.
* Erkek > ayakkabı kategorisi içerisinden 3 alana bir bedava indirimi uygulanacak.
* Siparişi tamamla işleminde adres bilgisi girip ödeme yöntemlerinden "Kapıda ödeme" seçeneğini seçip siparişini
  tamamlayabilecek.

## Proje Çözümleri

* config/packages/security.yaml içerisinden yetkilendirme ayarı yapıldı.
* EasyAdmin CRUD Controller kullanıldı.
* Category tablosu parent ile children arasında ilişki kuruldu.(OneToMany / ManyToOne)
* Category ve Product tabloları arasında ilişki kuruldu.(ManyToMany)
* Sipariş tablosundaki status(boolean) üzerinden onay durumu sağlanır.
* Twig üzerinden kullanıcının giriş yapıp yapmadığı tespit edilip koşullara göre gerekli işemleri yapma yetkisi
  sağlandı.
* Sepete birden fazla ürün eklenmesi durumunda, ödeme ekranında en uygun fiyatlı ürün tutarında indirim sağlandı.
* Sepetteki ürünlerden erkek ayakkabı kategorisine ait olan ürünler tespit edilip 3 adet veya fazlası var ise ödeme
  ekranında en uygun fiyatlı ayakkabı tutarında indirim sağlandı.
* Ödeme ekranında online ve kapıda ödeme seçenekleri eklendi fakat online ödeme inaktif durumda olduğu için kapıda ödeme
  seçeneği otomatik seçili olarak gelmektedir.

## Sistemdeki Kullanıcılar

### Kullanıcı Bilgileri

Admin:

* email = admin@example.com
* password = admin

Müşteri:

* email = customer@example.com
* password = customer

### Kullanıcı Yetkileri

Admin

* /admin üzerinde bulunan admin panele erişebilir.
* Ürün CRUD işlemleri yapabilir.
* Kategori CRUD işlemleri yapabilir.
* Sipariş CRUD işlemleri yapabilir.
* Sipariş onaylama işlemi yapabilir.
* İndirim CRUD işlemleri yapabilir.
* Kullanıcı Adresleri CRUD işlemleri yapabilir.

Müşteri

* Hesap oluşturabilir.
* Sepete ürün ekleme/çıkarma işlemleri gerçekleştirebilir.
* Sipariş tamamlama işlemini gerçekleştirebilir.

## Kurulum

Projeyi klonlayın:

```bash
git clone https://github.com/fhrvrdr/symfony-ecommerce.git
```

Proje Klasörüne Gidin:

```bash
cd symfony-ecommerce
```

Docker container oluşturun:

```bash
docker-compose up -d --build
```

Docker içerisinden php terminali açın ve bağımlılıkları indirin:

```bash
composer install
```

## Konfigürasyon

PhpMyAdmin sayfasına giriş yapın:

```bash
localhost:8082
user:root
password:123456
```

PhpMyAdmin üst panelden içe aktar kısmından veritabanı dosyasını import edin.

