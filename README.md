Universal
=========

Universal is a general proprose PHP library, includes these items beloew

- ClassLoaders
- FileUtils
- HTTPRequest handler

## Classloader

### SplClassLoader

    use Universal\ClassLoader\SplClassLoader;
    $loader = new \UniversalClassLoader\SplClassLoader( array(  
            'Vendor\Onion' => 'path/to/Onion',
            'Vendor\CLIFramework' => 'path/to/CLIFramework',
    ));
    $loader->addNamespace(array( 
        'NS' => 'path'
    ));
    $loader->useIncludePath();
    $loader->register();

### BasePathClassLoader

    $loader = new BasePathClassLoader( array( 
        'vendor/pear', 'external_vendor/src'
    ) );
    $loader->useEnvPhpLib();
    $loader->register();

## HttpRequest

For multiple files:

    $req = new HttpRequest;
    foreach( $req->files->uploaded as $f ) {
        $extname = $f->getExtension();
        $filename = $f->getPathname();
    }

    $req->param( 'username' );   // get $_REQUEST['username'];

    $req->get->username;    // get $_GET['username'];

    $req->post->username;   // get $_POST['username'];

    $req->server->path_info;  // get $_SERVER['path_info'];

## Event

    use Universal\Event\PhpEvent;
    $e = PhpEvent::getInstance();

    // register your handler
    $e->register( 'test', function($a,$b,$c) {
        // do what you want

    });

    // trigger event handlers
    $e->trigger( 'test' , 1,2,3  );

## Requirement Checker

    try {
        $require = new Universal\Requirement\Requirement;
        $require->extensions( 'apc','mbstring' );
        $require->classes( 'ClassName' , 'ClassName2' );
        $require->functions( 'func1' , 'func2' , 'function3' )
    }
    catch( RequireExtensionException $e ) {

    }
    catch( RequireFunctionException $e ) {

    }
    catch( RequireClassException $e ) {

    }
