( function ( blocks, element, data, blockEditor ) {
    var el = element.createElement,
        registerBlockType = blocks.registerBlockType,
        useSelect = data.useSelect,
        useBlockProps = blockEditor.useBlockProps;

    registerBlockType( 'n0x/breadcrumbs', {
        apiVersion: 2,
        title: 'n0x breadcrumbs',
        icon: 'media-code',
        category: 'widgets',
        edit: function () {
                  const array = [''];
                  var pids;
            var content;
            var blockProps = useBlockProps();
            var posts = useSelect( function ( select ) {
                return select( 'core' ).getEntityRecords( 'postType', 'post', { per_page: -1 } );
            }, [] );
            if ( ! posts ) {
                content = 'Loading...';
            } else if ( posts.length === 0 ) {
                content = 'No posts';
            } else {
                        pids = '';
                posts.forEach(function (item) {
                                  console.log(item);
                                   // array.push(item.link);
                                  content += el('p', item.link);
                                  //return item.link;
                                    
                                    
                        });
            }
                  return content;
                  //return el( 'div', blockProps, content);
            //return el( 'div', blockProps, array );
            
        },
    } );
} )(
    window.wp.blocks,
    window.wp.element,
    window.wp.data,
    window.wp.blockEditor
);