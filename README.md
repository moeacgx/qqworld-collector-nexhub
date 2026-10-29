# QQWorld Collector Deluxe — Nexhub 开心版

基于 QQWorld Collector Deluxe **5.0.0 beta1** 的开心版本。

- 原作者：Michael Wang / QQWorld
- 二次开发：**Nexhub**
- Telegram：https://t.me/zhanzhangck
- 发布标识：`v5.0.0-beta1-nexhub.20261029`；插件头部版本仍为 `5.0.0 beta1`。

## 目录

- `qqworld-collector/`：完整插件目录，包含实际运行的 `phar/collector.phar`。
- `src/collector-phar/`：从上述 PHAR 本体解包的可读源码，供审阅和维护；运行时使用插件目录中的 PHAR。
- `release-manifest.json`：插件文件、PHAR 源码及发布附件的 SHA256 清单。

## 安装和下载

在 [Releases](../../releases) 下载 `qqworld-collector-live-20261029.zip`，通过 WordPress 插件上传功能安装，或解压为 `wp-content/plugins/qqworld-collector/`。替换现有安装前备份插件及站点数据。

需要 SDK 备份时下载 `qqworld-collector-plugin-and-sdk-20261029.zip`；其中保留插件安装 ZIP 和 12 个各自独立的 SDK ZIP。各 SDK ZIP 也作为独立 Release 附件提供。

SDK 备份来自插件 PHAR 中的相关 SDK 与适配目录，属于目录重新打包，不代表厂商原始下载包。依赖的原有授权与版权声明按各文件保留。

## 本次维护内容

- 增加 Nexhub 二开信息及 Telegram 联系方式，保留原作者信息。
- 修复已确认的远程发布凭据泄露入口，增加管理权限、nonce 和配置过滤。
- 收紧远程推送的 HTTPS、TLS 校验及重定向凭据行为。
- 限制动态代码执行和遗留公开接口；保留现有安全层。

插件曾在 PHP 8.2 与 PHP 8.5 的站点完成加载检查；这不覆盖所有采集规则、远程推送及云存储业务。服务器侧源码、PHAR、日志与配置访问防护属于站点配置，不会随插件 ZIP 自动安装。

## 源码和发行包一致性

解包源码逐文件验证 PHAR 清单、长度和 CRC。安装包与仓库的 `qqworld-collector/` 文件一致；Release 附件可按 SHA256 清单核验。仓库不包含站点配置、数据库备份或运维凭据。
