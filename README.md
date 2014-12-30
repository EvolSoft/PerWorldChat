# PerWorldChat

Per World Chat plugin for PocketMine-MP

## Category

PocketMine-MP plugins

## Requirements

PocketMine-MP Alpha_1.4 API 1.9.0

## Overview

**PerWorldChat** allows you to have a single chat for each world.

**EvolSoft Website:** http://www.evolsoft.tk

***This Plugin uses the New API. You can't install it on old versions of PocketMine.***

With PerWorldChat you can have a single chat for each world and you can disable chat in worlds. (read documentation)

**To-Do:**

*- Bug fix (if bugs will be found)*

## Documentation 

**Configuration (config.yml):**
```yaml
---
#Chat Format
#Available tags:
# - {WORLD}: Show world name
# - {PLAYER}: Show player name
# - {MESSAGE}: Show message
chat-format: "[{WORLD}] <{PLAYER}> {MESSAGE}"
#Log to player when chat is disabled in world
log-chat-disabled: true
#Log messages on PocketMine console
log-on-console: true
#World list where chat is disabled
disabled-in-worlds: []
...
```


