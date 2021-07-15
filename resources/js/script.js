$( function () {
    $( '.btn-delete' ).click( function() {
        let id = $( this ).data( 'contact-id' );

        $( '#deleteConfirm' ).modal( 'show' );

        $( '.btn-yes' ).click( function() {
            window.location = APP_URL + '/delete_contact/' + id;
        });
    });

    var typing_timer;
	var typing_interval = 500;

	$( '.search-contact' ).on( 'keyup', function( e ) {
		clearTimeout( typing_timer );

		typing_timer = setTimeout( function() {
            if ( $( '.search-contact' ).val() != '' ) {

                $( '.search-result table tbody' ).html( '' );

                $.ajax( {
                    url : APP_URL + '/search_contact',
                    data : { 'term' : $( '.search-contact' ).val() },
                    type : 'get',
                    dataType : 'json', 
                    success : function ( result ) {
                        if ( result.length > 0 ) {
                            for( let i = 0; i < result.length; i++ ) {
                                $( '.search-result table tbody' ).append(
                                    '<tr>' +
                                        '<td>' + result[ i ].name + '</td>' +
                                        '<td>' + result[ i ].company + '</td>' +
                                        '<td>' + result[ i ].phone + '</td>' +
                                        '<td>' + result[ i ].email + '</td>' +
                                        '<td> ' +
                                            '<a href="/edit_contact/' +  result[ i ].id + '"> ' +
                                                '<input type="button" value="Edit" class="btn btn-success btn-sm " /> ' +
                                            '</a> ' +
                                            '<input type="button" data-contact-id="' +  result[ i ].id + '" value="Delete" class="btn btn-danger btn-sm btn-delete" /> ' +
                                        '</td> ' +
                                    '</tr>'
                                );
                            }
                        }
                        
                        $( '.search-result table tbody .btn-delete' ).click( function() {
                            let id = $( this ).data( 'contact-id' );
                    
                            $( '#deleteConfirm' ).modal( 'show' );
                    
                            $( '.btn-yes' ).click( function() {
                                window.location = '/delete_contact/' + id;
                            });
                        });
                    }
                } );

                $( '.list-result' ).addClass( 'd-none' );
                $( '.search-result' ).removeClass( 'd-none' );
            } else {
                $( '.list-result' ).removeClass( 'd-none' );
                $( '.search-result' ).addClass( 'd-none' );
            }
        }, typing_interval );
	} );

	$( '.search-contact' ).on( 'keydown', function( e ) {
		clearTimeout( typing_timer );
	} );
}) ;