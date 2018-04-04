Add

```
Nomidi\BugherdHeroTool:
  project_key: 'xxx'
  environment_type: 'dev'
  member_status: false
```
to your config.yml then replace 'xxx' with your bugherd.com project ID. Please
ensure to enter your project key with enclosing quotation marks.
Via the parameter environment_type it is possible to tell the module under which
environment type it will be active. Possible values are **dev**,**test** and
**live**. If this parameter is not set the module will just work under the
**dev** environment.
Via the parameter member_status it is possible to configure the module if it
will be visible for every site visitor or if this will just appear for logged
in user. Possible values are **false** (which means for every user) and
**true** which will show the Bugherd interface just to signed in user. A destinction
of different signed in user (like admin and editors) is right now not planned.

## Installation
__Composer (recommended):__
```
composer require nomidi/silverstripe-bugherd-hero-tool
```
