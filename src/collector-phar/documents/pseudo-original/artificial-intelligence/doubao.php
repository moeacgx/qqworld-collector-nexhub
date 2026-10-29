<h2>模型与价格</h2>
<p>豆包的模型介绍可以看<a href="https://www.volcengine.com/product/doubao" target="_blank">豆包大模型介绍</a>，模型价格可以看<a href="https://www.volcengine.com/docs/82379/1099320" target="_blank">豆包定价文档</a>里的“模型推理” - “大语言模型” - “字节跳动”部分。</p>

<p>推荐使用以下模型：</p>
<ul>
 	<li>Doubao-lite-32k：每百万 token 的输入价格为 0.3 元，输出价格为 0.6 元</li>
 	<li>Doubao-pro-32k：每百万 token 的输入价格为 0.8 元，输出价格为 2 元</li>
</ul>
<blockquote>
<ul>
 	<li>豆包的 6 个模型中，4k 和 32k 的价格是一样的，所以这里推荐用 32k 的模型。</li>
 	<li>每个模型都有 50 万 tokens 的免费额度，不会过期。
<ul>
 	<li>剩余免费额度见<a href="https://console.volcengine.com/ark/region:ark+cn-beijing/openManagement" target="_blank">开通管理 ｜ 火山方舟管理控制台</a>里的“免费推理额度”。</li>
 	<li>豆包一共有 6 个模型，也就是说上面这两个模型的 token 用完之后，你还可以切换为别的模型使用。</li>
</ul>
</li>
 	<li>“输入”即你发送给模型的语音文字，“输出”即模型提供的回答，问答一次的最终花费 = 输入 token 数量 * 输入价格 + 输出 token 数量 * 输出价格。</li>
 	<li>1 个 token 大约对应 1 个汉字或 3 至 4 个字母。</li>
</ul>
</blockquote>
<h2>申请步骤</h2>
<h3>第一步：注册账号</h3>
<p>进入<a href="https://console.volcengine.com/ark/" target="_blank">火山方舟管理控制台</a>，根据提示注册或登陆账号。</p>
<h3>第二步：开通模型</h3>
<p>进入<a href="https://console.volcengine.com/ark/region:ark+cn-beijing/openManagement" target="_blank">开通管理</a>，点击 <code>Doubao-pro-4k</code> 最右边的【开通服务】按钮，会弹出来一个弹窗。</p>

<p>在弹窗中勾选豆包的 6 个模型（<code>Doubao-pro-4k</code>、<code>Doubao-pro-8k</code>、<code>Doubao-pro-32k</code>、<code>Doubao-lite-4k</code>、<code>Doubao-lite-8k</code>、<code>Doubao-lite-32k</code>），然后点击【立即开通】。</p>

<h3>第三步：创建 API Key</h3>
<p>进入 <a href="https://console.volcengine.com/ark/region:ark+cn-beijing/apiKey" target="_blank">API Key 管理</a>，点击【创建 API Key】，填写名称“划词翻译”后创建 API Key 备用。</p>
<h3>第四步：创建接入点</h3>
<p>豆包的模型不能直接使用，要先在平台内创建接入点了之后才能使用。</p>

<p>以 Doubao-pro-32k 为例：</p>
<ol>
 	<li>进入<a href="https://console.volcengine.com/ark/region:ark+cn-beijing/endpoint" target="_blank">在线推理</a> 的 <em>自定义推理接入点</em>，点击【创建推理接入点】。</li>
 	<li>点击【添加模型】按钮，会出现一个弹窗。
<ul>
 	<li>在模型广场中选择“Doubao-pro-32k”，然后右侧会出现模型版本。</li>
 	<li>模型版本一般只有一个，名称就是 6 个数字组成的日期（例如 <code>240515</code>），但也有可能会有带前缀的版本（例如 <code>functioncall-240515</code>、<code>character-240528</code>）。</li>
 	<li>模型版本要<strong>选择不带前缀的版本</strong>，即类似 <code>240515</code> 这样只有 6 个数字的版本。</li>
 	<li>选好模型版本后，点击页面右下角的【添加】。</li>
</ul>
</li>
 	<li>名称建议就填写“接入模型”那里显示的文本，例如“Doubao-pro-32k-240515”（把斜线 <code>/</code> 改为短横线 <code>-</code>）。</li>
 	<li>点击页面右侧的【接入模型】按钮。</li>
</ol>
<p>然后，你就会回到<a href="https://console.volcengine.com/ark/region:ark+cn-beijing/endpoint" target="_blank">在线推理</a>页面，此时表格中会看到你刚才创建的名为“Doubao-pro-32k-240515”的接入点，<strong>名称下方有一串以 <code>ep-</code> 开头的、格式为 <code>ep-xxxxxxxxxx-xxxxx</code> 的文本，这就是我们需要的接入点 ID</strong>，复制后备用。</p>

<p>当你想要使用别的模型时，你需要重复以上步骤，创建新的接入点。建议为每个模型都提前创建好接入点。</p>

<h3>可选步骤：更新模型</h3>
<p>当你在第四步创建接入点之后，这个接入点所使用的模型将被固定在那个版本。</p>
<p>举个例子，在第四步你创建接入点之后，你所使用的 Doubao-pro-32k 模型将被固定在 <code>240515</code> 这个版本，但模型以后是会更新的，也就是会有 <code>250923</code>、<code>260106</code> 等新版本。</p>
<p>如果你想要使用新版本的模型，你需要重复第五步的步骤创建新的接入点。</p>