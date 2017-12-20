<?xml version="1.0" encoding="UTF-8" ?>
<OpenSearchDescription xmlns="http://a9.com/-/spec/opensearch/1.1/">
    <ShortName>[{$oShop->getFieldData('oxname')}]</ShortName>
    <InputEncoding>UTF-8</InputEncoding>
    <OutputEncoding>UTF-8</OutputEncoding>
[{if $blHasIcon}]
    <Image height="[{$aImgInfo[1]}]" width="[{$aImgInfo[0]}]">data:[{$aImgInfo.mime}];base64, [{$sBase64Icon}]</Image>
[{/if}]
    <Url type="text/html" template="[{$sShopUrl}]index.php?cl=search&amp;searchparam={searchTerms}" />
    <Url type="application/x-suggestions+json" method="GET" template="[{$sShopUrl}]index.php?fnc=d3_browser_suggest&amp;searchparam={searchTerms}" />
</OpenSearchDescription>