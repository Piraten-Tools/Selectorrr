{* Description buttons for markdown *}

<div class="btn-group" role="group" aria-label="...">
    <button type="button" id="rich-editor-button" class="btn btn-default btn-xs{if $default_to_marldown_editor} active{/if}">{__('PollInfo', 'Rich editor')}</button>
    <button type="button" id="simple-editor-button" class="btn btn-default btn-xs{if !$default_to_marldown_editor} active{/if}">{__('PollInfo', 'Simple editor')}</button>
</div>

<a href="" data-toggle="modal" data-target="#markdown_modal"><i class="glyphicon glyphicon-info-sign"></i></a><!-- TODO Add accessibility -->
