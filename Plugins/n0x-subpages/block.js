( function ( blocks, element, data, blockEditor ) {
    var el = element.createElement,
        registerBlockType = blocks.registerBlockType,
        useSelect = data.useSelect,
        useBlockProps = blockEditor.useBlockProps;

    registerBlockType( 'n0x/subpages', {
        apiVersion: 2,
        title: 'n0x subpages',
        icon: 'media-code',
        category: 'widgets',
        edit: function () {
            return 'n0x Sub pages added'
        },
    } );
} )(
    window.wp.blocks,
    window.wp.element,
    window.wp.data,
    window.wp.blockEditor
);