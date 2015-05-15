function ucwords_improved(s)
{
  // original by: Weliton Fonseca Amaral (dfweliton@gmail.com)
	  
		e = Array( 'da', 'das', 'de', 'do', 'dos', 'e' );
        return join(' ',
                           array_map(
                                   create_function(
                                           's',
                                           "return !in_array(s, e) ? ucfirst(s) : s;"
                                   ),
                                   explode(
                                           ' ',
                                           strtolower(s)
                                   )
                           )
                   );
}
