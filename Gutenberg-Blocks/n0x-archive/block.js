( function ( blocks, element, data, blockEditor ) {
    var el = element.createElement,
        registerBlockType = blocks.registerBlockType,
        useSelect = data.useSelect,
        useBlockProps = blockEditor.useBlockProps;

    registerBlockType( 'n0x/archive', {
        apiVersion: 2,
        title: 'n0x archive',
        icon: 'media-code',
        category: 'widgets',
        edit: function () {
			const array = [''];
			var pids;
            var content;
            var blockProps = useBlockProps();
            var posts = useSelect( function ( select ) {
                return select( 'core' ).getEntityRecords( 'postType', 'page', { per_page: 10 } );
            }, [] );
            if ( ! posts ) {
                content = 'Loading...';
            } else if ( posts.length === 0 ) {
                content = 'No posts';
            } else {
				pids = '';
                posts.forEach(function (item) {
					    console.log(item.guid.raw);
						array.push(item.guid.raw);
					    //content += el( 'a', {item.guid.raw}, item.guid.raw );
						
						
				});
            }
			//return content;
            return el( 'div', blockProps, array );
            
        },
    } );
} )(
    window.wp.blocks,
    window.wp.element,
    window.wp.data,
    window.wp.blockEditor
);