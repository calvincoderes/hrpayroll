var fs = require('fs');
var replaceall = require("replaceall");
var assets = '';

var generateView = function( resource ) {

	var a = ["index", "form", "show"];

	a.forEach(function(row) {
		var content = fs.readFileSync('resources/views/reference/crud-' + row + '.blade.php', 'utf8');
		createFile('resources/views/crud/' + resource + '-' + row + '.blade.php', content);
	});

}

var generateController = function( table, controller ) {
	var content  = "<?php namespace App\\Http\\Controllers;\n\n" +
					"class " + controller  + "Controller extends CrudController {\n\n" + 
					"}";

	createFile('app/Http/Controllers/' + controller + 'Controller.php', content);
}

var generateModel = function( table, model ) {

	var content  = "<?php namespace App\\Models;\n\n" +
					"use Illuminate\\Database\\Eloquent\\SoftDeletes;\n" + 
					"use Illuminate\\Database\\Eloquent\\Model;\n\n" + 
					"class " + model + " extends Model {\n\n" + 
					"\tuse SoftDeletes;\n\n" + 
					"\tprotected \$table = '"+ table + "';\n\n" + 
					"\tprotected \$dates = ['deleted_at'];\n\n" + 
					"}";

	createFile('app/Models/' + model + '.php', content);		
}

var generateLanguage = function( name, local ) {
	var local = 'en';

	var ucName = name.toLowerCase().replace(/\b[a-z]/g, function(letter) {
	    return letter.toUpperCase();
	});

	var title = replaceall('_', ' ', ucName);

	var content = fs.readFileSync('resources/lang/reference/crud-default.php', 'utf8');
		content = replaceall("Title", title, content);
		content = replaceall("breadcrumbs-title", ucName, content);
		content = replaceall("breadcrumbs-link", name.toLowerCase(), content);

	createFile('resources/lang/' + local + '/crud-' + name + '.php', content );
}

var generateJavaScripts = function( name ) {
	createFile('public/js/crud/jquery.' + name + '-form.js', '$(\'.summernote\').summernote({ height: 300 }); $(\'select\').select2();' );
	createFile('public/js/crud/jquery.' + name + '-list.js', '$(\'select\').select2();' );
}

var generateStylesheets = function( name ) {
	createFile('public/css/crud/style.' + name + '-form.js', '' );
	createFile('public/css/crud/style.' + name + '-list.js', '' );
}

var createFile = function( file_path, content ) {
	fs.stat(file_path, function(err, stat) {
		    if( err == null )
		        console.log(file_path + ' EXISTS');
		    else if(err.code == 'ENOENT') {
			    fs.writeFile(file_path, content, function(err) {
				    if(err) {
				        return console.log(err);
				    }
				    console.log('CREATED ' + file_path );
				});
		    } else
				console.log('Some other error: ', err.code);
	});
}

process.argv.forEach(function (resource, index, array) {
	if( index == 2 ) {

		var className = replaceall('_', ' ', resource);

		className = className.toLowerCase().replace(/\b[a-z]/g, function(letter) {
		    return letter.toUpperCase();
		});

		className = replaceall(' ', '', className);

		generateView( resource );
		generateController( resource, className );
		generateModel( resource, className );
		generateLanguage( resource, 'en');
		generateJavaScripts( resource );
		generateStylesheets( resource );
	}
});