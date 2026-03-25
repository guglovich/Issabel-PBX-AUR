# Issabel PBX AUR Packages

This repository contains source tarballs for building Issabel PBX packages on Arch Linux.

## About Issabel

Issabel is an open source unified communications solution based on Asterisk PBX. It provides:
- PBX management web interface
- Voicemail and conferencing
- Call recording and routing
- System administration tools

## Packages

| Package | Version | Description |
|---------|---------|-------------|
| issabel-framework | 5.0.0 | Core framework and web interface |
| issabel-system | 5.0.0 | System management modules |
| issabel-pbx | 5.0.0 | PBX logic and AGI scripts |
| issabelpbx | 2.12.0 | Asterisk configuration GUI |

## Installation (AUR)

```bash
# Install all packages
paru -S issabel-framework issabel-system issabel-pbx issabelpbx
```

## Default Credentials

- **URL:** http://localhost:8080/index.php
- **Username:** admin
- **Password:** admin1234

**⚠️ Change the default password immediately!**

## Source

These packages are based on the official Issabel source code:
- https://github.com/IssabelFoundation

## License

GPLv2/GPLv3

## Note

This is an unofficial Arch Linux port. For official Issabel support, visit:
- Website: https://www.issabel.org
- Forum: https://community.issabel.org
