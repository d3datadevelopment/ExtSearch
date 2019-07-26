[{$smarty.block.parent}]

<tr>
    <td class="edittext" style="width:120px">
        <label for="d3push">[{oxmultilang ident="D3_EXTSEARCH_PUSH"}]</label>
    </td>
    <td class="edittext">
        <select id="d3push" class="edittext" name="editval[oxarticles__d3push]" size="1">
            <option value="1"
            [{if $edit->oxarticles__d3push->value == 1}]selected[{/if}]>[{oxmultilang ident="D3_EXTSEARCH_PUSH_1"}]</option>
            <option value="2"
            [{if $edit->oxarticles__d3push->value == 2}]selected[{/if}]>[{oxmultilang ident="D3_EXTSEARCH_PUSH_2"}]</option>
            <option value="3"
            [{if $edit->oxarticles__d3push->value == 3}]selected[{/if}]>[{oxmultilang ident="D3_EXTSEARCH_PUSH_3"}]</option>
        </select>
        [{oxinputhelp ident="D3_EXTSEARCH_PUSH_DESC"}]
    </td>
</tr>