# Octopress for WordPress

沿用 [Octopress](https://octopress.org/) 排版风格的 WordPress 主题。黑白极简、单栏正文加右侧栏、代码块高亮，不依赖任何页面构建工具。

- 版本：2.0（见 `style.css`）
- 许可证：GNU General Public License

## 特性

- 首页与归档页输出文章全文，不做摘要截断，接近 Octopress 的阅读体验
- 单篇文章支持分页（`wp_link_pages()`）、上一篇/下一篇
- 评论模板沿用 Twenty Eleven，支持嵌套回复与 pingback/trackback
- 侧边栏：一个小工具区 + 一栏「随机文章」
- 响应式：屏幕宽度小于 750px 时隐藏页头、导航、侧栏与页脚
- 前端脚本本地打包，不依赖 jQuery

## 安装

```bash
cd wp-content/themes
git clone git@github.com:wuwx/wordpress-theme-octopress.git octopress
```

在后台「外观 → 主题」中启用 Octopress。主题不需要额外配置，启用后到「外观 → 小工具」把需要的小工具拖进默认侧边栏即可。

## 目录结构

```
.
├── style.css            主题声明与响应式规则，@import 两个样式表
├── stylesheets/         screen.css、comments.css
├── images/              背景、噪点、搜索图标等贴图
├── javascripts/         modernizr-2.0.4、ender、octopress.js
├── functions.php        关闭管理工具栏、评论回调、注册侧边栏
├── header.php           页头、站点标题、搜索框、页面导航
├── footer.php           页脚、wp_footer()
├── index.php            首页 / 兜底模板
├── single.php           单篇文章
├── page.php             独立页面
├── archive.php          分类、标签、日期归档
├── sidebar.php          侧边栏
└── comments.php         评论列表与评论表单
```

## 前端依赖

| 库 | 版本 | 说明 |
| --- | --- | --- |
| Ender | 0.3.4 | 打包了 Qwery、Bonzo、Bean、Reqwest、domready，提供 `$` |
| Modernizr | 2.0.4 | 特性检测，含 video、respond、mq |
| highlight.js | 6.1 | 代码高亮，`header.php` 中通过 CDN 引入 |

## 持续集成

`.github/workflows/compat.yml` 在 push、PR 和每周一定时运行：

- `lint`：对所有 PHP 文件执行 `php -l`
- `smoke`：用 wp-cli 起一个真实的 WordPress（MySQL 8 + PHP 8.2），装入并激活主题，造文章、分页文章、独立页面、分类、带密码文章、评论等测试数据，然后用内置服务器请求首页、首页第二页、单篇及多页文章的后续页、独立页面、分类归档、搜索、404、登录页，断言状态码正确且页面里没有 PHP 致命错误、警告或 Notice

`smoke` 覆盖最新 WordPress 与上一条版本线。定时任务的意义在于 WordPress 发新版时能第一时间发现主题被上游改挂，而不是等有人访问站点才发现。

## 来源

版式风格来自 Brandon Mathis 的 Octopress（MIT）；评论模板与评论回调改写自 WordPress 默认主题 Twenty Eleven（GPL）；`javascripts/octopress.js` 取自 Octopress 的前端脚本，Ender 与 Modernizr 按原许可打包。本仓库做的是把这些拼成一个可直接安装的 WordPress 主题。

## 已知限制

- `header.php` 里 highlight.js 走 `yandex.st`，该 CDN 已停止服务，代码块目前不会高亮，需要换源或改成本地文件
- 使用 `wp_title()` 拼 `<title>`，未声明 `add_theme_support( 'title-tag' )`
- 未适配区块编辑器，编辑器样式与前台不完全一致
- 没有 `404.php` 和 `search.php`，分别回落到 `index.php`
- 侧边栏「随机文章」使用 `orderby=rand`，文章量很大时会全表排序
