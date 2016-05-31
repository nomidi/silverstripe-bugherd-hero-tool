Bugherd Hero Tool
=================

Easy implementation of bugherd.com

bugherd.com is an online bug tracking service. For more information about
bugherd.com please visit the website : http://bugherd.com
Neither of the module developer is in liaison with bugherd. For any question or
problem with bugherd please refer to http://bugherd.com
This module should just offer an easy way to integrate bugherd into a SilverStripe
project.

## Requirements
* SilverStripe 3.1

## Usage

Add

```
BugherdHeroTool:
  project_key: 'xxx'
  environment_type: 'dev'
  member_status: false
```
to your config.yml then replace 'xxx' with your bugherd.com project ID. Please
ensure to enter your project key with enclosing quotation marks.
The other parameter (environment_type and member_status) are optional. For
further information please stick to the documentation.

## Installation
__Composer (recommended):__
```
composer require nomidi/silverstripe-bugherd-hero-tool
```

## Licensing
For all quesitons regarding Licensing pleasee see the [LICENSE.md](LICENSE.md).

## Maintainer Contact

* Bastian Fritsch (Nickname: nomidi) <mail@bastian-fritsch.de>
* Armin Eden <eden@bit-basti.de>

## Contributing / Feature request
Please refer to the [CONTRIBUTING.md](CONTRIBUTING.md) within this package.

## SourceCode
The SourceCode of this project can be found on Github. https://github.com/nomidi/silverstripe-bugherd-hero-tool
