# Maintainer: guglovich <your@email.com>
pkgname=issabel-pbx
pkgver=5.0.0
pkgrel=1
pkgdesc="[BETA] Issabel PBX - Unified Communications Solution for Arch Linux"
arch=('any')
url="https://github.com/guglovich/Issabel-PBX-AUR"
license=('GPL2' 'GPL3')
depends=('php-legacy' 'php-legacy-gd' 'php-legacy-apache' 'php-legacy-sqlite' 'apache' 'mariadb' 'sqlite' 'sudo' 'net-tools' 
         'iproute2' 'postfix' 'tar' 'asterisk' 'psmisc' 'gettext' 'perl' 'wget' 'mpg123' 'sox')
install=issabel-pbx.install
backup=(
  'etc/httpd/conf/extra/issabel.conf'
  'etc/php/conf.d/issabel.ini'
  'etc/sudoers.d/issabel'
  'etc/issabelpbx.conf'
  'etc/amportal.conf'
)
source=(
  "issabel-framework-$pkgver.tar.gz::https://github.com/guglovich/Issabel-PBX-AUR/releases/download/v$pkgver/issabel-framework-$pkgver.tar.gz"
  "issabel-system-$pkgver.tar.gz::https://github.com/guglovich/Issabel-PBX-AUR/releases/download/v$pkgver/issabel-system-$pkgver.tar.gz"
  "issabel-pbx-$pkgver.tar.gz::https://github.com/guglovich/Issabel-PBX-AUR/releases/download/v$pkgver/issabel-pbx-$pkgver.tar.gz"
  "issabelPBX-2.12.0.tar.gz::https://github.com/guglovich/Issabel-PBX-AUR/releases/download/v$pkgver/issabelPBX-2.12.0.tar.gz"
  "smarty-3.1.39.tar.gz::https://github.com/smarty-php/smarty/archive/refs/tags/v3.1.39.tar.gz"
  "issabelpbx.conf"
  "PEAR.php"
)
sha256sums=(
  'a771df51bb392a2431e7021f524f58a6d03efb94a3fb5f138307bea6ec2ca70a'
  '8993b0bfca1921054d3244cfd7eaa24c36be5baf1be18cebd613c0e4338ab5dc'
  '97415b360dc2e01ca34e39cd6c2dfca46c57a22caa6abcccefba906f97d57e0c'
  '9de3a217ddccc3d8ec8e3971fbac9c30eb477b8c434d46f6b45ce290c7f676a6'
  'SKIP'
  'SKIP'
  'f3e89a3cea52b69e7ce6ace487aeecc9031364330d90e3cfd573b838162aa03a'
)

prepare() {
  cd "$srcdir"
  # Extract all sources for package()
  bsdtar -xf smarty-3.1.39.tar.gz
}

package() {
  # Install Smarty 3.1.39
  install -d "${pkgdir}/usr/share/php/Smarty"
  cd "$srcdir/smarty-3.1.39/libs"
  cp -r * "${pkgdir}/usr/share/php/Smarty/"

  # Framework
  cd "$srcdir/issabel-framework"
  install -d "${pkgdir}/var/www/html"
  cp -r "framework/html/"* "${pkgdir}/var/www/html/"
  install -d "${pkgdir}/var/www/db" "${pkgdir}/var/www/backup"
  install -d "${pkgdir}/usr/bin"
  for f in additionals/usr/bin/*; do
    [ -f "$f" ] && install -m755 "$f" "${pkgdir}/usr/bin/"
  done
  install -d "${pkgdir}/usr/share/issabel/privileged"
  [ -d "framework/setup/usr/share/issabel/privileged" ] && cp -r framework/setup/usr/share/issabel/privileged/* "${pkgdir}/usr/share/issabel/privileged/"
  install -d "${pkgdir}/usr/share/issabel/module_installer/issabel-framework-${pkgver}-${pkgrel}/setup"
  cp -r framework/setup/db "${pkgdir}/usr/share/issabel/module_installer/issabel-framework-${pkgver}-${pkgrel}/setup/"
  install -d "${pkgdir}/etc/httpd/conf/extra"
  [ -f "additionals/etc/httpd/conf.d/issabel.conf" ] && install -m644 "additionals/etc/httpd/conf.d/issabel.conf" "${pkgdir}/etc/httpd/conf/extra/issabel.conf"
  install -d "${pkgdir}/etc/php/conf.d"
  [ -f "additionals/etc/php.d/issabel.ini" ] && install -m644 "additionals/etc/php.d/issabel.ini" "${pkgdir}/etc/php/conf.d/issabel.ini"
  install -d "${pkgdir}/etc/sudoers.d"
  [ -f "additionals/etc/sudoers" ] && install -m440 "additionals/etc/sudoers" "${pkgdir}/etc/sudoers.d/issabel"
  install -d "${pkgdir}/etc/logrotate.d"
  [ -d "additionals/etc/logrotate.d" ] && install -m644 additionals/etc/logrotate.d/* "${pkgdir}/etc/logrotate.d/"
  install -d "${pkgdir}/etc/cron.d"
  [ -f "additionals/etc/cron.d/issabel.cron" ] && install -m644 "additionals/etc/cron.d/issabel.cron" "${pkgdir}/etc/cron.d/issabel"
  install -d "${pkgdir}/var/www/html/var/templates_c" "${pkgdir}/var/www/html/var/cache" "${pkgdir}/var/www/html/cache"

  # System
  cd "$srcdir/issabel-system"
  install -d "${pkgdir}/var/www/html/modules"
  cp -r "modules/"* "${pkgdir}/var/www/html/modules/"
  install -d "${pkgdir}/var/www/html/libs"
  [ -f "setup/paloSantoNetwork.class.php" ] && install -m644 "setup/paloSantoNetwork.class.php" "${pkgdir}/var/www/html/libs/"
  install -d "${pkgdir}/var/www/backup"
  [ -f "setup/automatic_backup.php" ] && install -m644 "setup/automatic_backup.php" "${pkgdir}/var/www/backup/"
  install -d "${pkgdir}/usr/share/issabel/privileged"
  [ -d "setup/usr/share/issabel/privileged" ] && install -m755 setup/usr/share/issabel/privileged/* "${pkgdir}/usr/share/issabel/privileged/"
  install -d "${pkgdir}/usr/bin"
  [ -d "setup/usr/sbin" ] && install -m755 setup/usr/sbin/* "${pkgdir}/usr/bin/"
  install -d "${pkgdir}/usr/share/issabel/module_installer/issabel-system-${pkgver}-${pkgrel}"
  cp -r "setup" "${pkgdir}/usr/share/issabel/module_installer/issabel-system-${pkgver}-${pkgrel}/"

  # PBX
  cd "$srcdir/issabel-pbx"
  install -d "${pkgdir}/var/www/html/modules"
  cp -r "modules/"* "${pkgdir}/var/www/html/modules/"
  install -d "${pkgdir}/var/lib/asterisk/agi-bin" "${pkgdir}/var/lib/asterisk/moh"
  [ -d "setup/asterisk/agi-bin" ] && cp -r "setup/asterisk/agi-bin/"* "${pkgdir}/var/lib/asterisk/agi-bin/"
  [ -d "setup/asterisk/moh" ] && cp -r "setup/asterisk/moh/"* "${pkgdir}/var/lib/asterisk/moh/"
  install -d "${pkgdir}/usr/bin"
  [ -f "setup/bin/asterisk.reload" ] && install -m755 "setup/bin/asterisk.reload" "${pkgdir}/usr/bin/asterisk.reload"
  install -d "${pkgdir}/etc/cron.daily"
  [ -f "setup/etc/cron.daily/asterisk_cleanup" ] && install -m755 "setup/etc/cron.daily/asterisk_cleanup" "${pkgdir}/etc/cron.daily/asterisk_cleanup"
  install -d "${pkgdir}/usr/share/issabel/privileged"
  [ -d "setup/usr/share/issabel/privileged" ] && install -m755 setup/usr/share/issabel/privileged/* "${pkgdir}/usr/share/issabel/privileged/"
  install -d "${pkgdir}/etc/asterisk"
  [ -f "setup/etc/asterisk/sip_notify_custom_issabel.conf" ] && install -m644 "setup/etc/asterisk/sip_notify_custom_issabel.conf" "${pkgdir}/etc/asterisk/"
  [ -f "setup/extensions_override_issabel.conf" ] && install -m644 "setup/extensions_override_issabel.conf" "${pkgdir}/etc/asterisk/extensions_override_issabel.conf"
  install -d "${pkgdir}/var/www/html/admin"
  [ -f "setup/var/www/html/admin/issabel_issabelpbx_auth.php" ] && install -m644 "setup/var/www/html/admin/issabel_issabelpbx_auth.php" "${pkgdir}/var/www/html/admin/issabel_issabelpbx_auth.php"
  install -d "${pkgdir}/usr/share/issabel/module_installer/issabel-pbx-${pkgver}-${pkgrel}"
  cp -r "setup" "${pkgdir}/usr/share/issabel/module_installer/issabel-pbx-${pkgver}-${pkgrel}/"

  # PBX GUI
  cd "$srcdir/issabelPBX"
  install -d "${pkgdir}/var/www/html/admin/modules"
  for module in */; do
    [ -d "$module" ] && [ "$module" != "build/" ] && [ "$module" != ".git/" ] && cp -r "$module" "${pkgdir}/var/www/html/admin/modules/"
  done
  [ -d "framework" ] && cp -r "framework/"* "${pkgdir}/var/www/html/admin/"
  install -d "${pkgdir}/etc"
  install -m644 "${srcdir}/issabelpbx.conf" "${pkgdir}/etc/issabelpbx.conf"
  [ -f "framework/amportal.conf" ] && install -m644 "framework/amportal.conf" "${pkgdir}/etc/amportal.conf"
  install -d "${pkgdir}/usr/share/pear"
  install -m644 "${srcdir}/PEAR.php" "${pkgdir}/usr/share/pear/PEAR.php"
  install -d "${pkgdir}/etc/logrotate.d"
  [ -f "build/5.0/files/issabelpbx.logrotate" ] && install -m644 "build/5.0/files/issabelpbx.logrotate" "${pkgdir}/etc/logrotate.d/issabelpbx"
  install -d "${pkgdir}/var/log/asterisk"
  install -d "${pkgdir}/var/log/issabel"
}
