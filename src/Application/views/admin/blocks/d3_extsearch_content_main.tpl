[{$smarty.block.parent}]

<tr id="d3issearchable">
    <td class="edittext">
        <label for="d3issearchable">[{oxmultilang ident="D3_EXTSEARCH_CONTENT_SEARCHABLE"}]</label>
    </td>
    <td class="edittext">
        <input type="hidden" name="editval[oxcontents__d3issearchable]" value="0">
        <input type="checkbox" name="editval[oxcontents__d3issearchable]" id="d3issearchable" value="1" class="edittext" [{if $edit->oxcontents__d3issearchable->value == 1}]CHECKED[{/if}] [{$readonly}]>
    </td>
</tr>