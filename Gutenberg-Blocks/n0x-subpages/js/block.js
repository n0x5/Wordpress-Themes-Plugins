(function( blocks, element, components, i18n ) {
    var el = element.createElement;
    var __ = i18n.__;
    var ServerSideRender = components.ServerSideRender;

    blocks.registerBlockType( 'custom/subpages-list', {
        title: __( 'Subpages List', 'subpages-block' ),
        icon: 'list-view',
        category: 'widgets',
        description: __( 'Displays a list of sub-pages with featured images if available.', 'subpages-block' ),
        edit: function( props ) {
            return el(
                'div',
                { className: 'subpages-block-editor' },
                el( ServerSideRender, {
                    block: 'custom/subpages-list',
                    attributes: props.attributes,
                } )
            );
        },
        save: function() {
            // This block is rendered server-side, so save function returns null
            return null;
        },
    } );
}(
    window.wp.blocks,
    window.wp.element,
    window.wp.components,
    window.wp.i18n
) );
