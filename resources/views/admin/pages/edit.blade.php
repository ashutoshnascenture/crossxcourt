 @extends('admin')
@section('content')
<script src="{{ asset('/js/ckeditor.js') }}"></script>


 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h2>Update {{ $page->title }}</h2>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="inner-content">

                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form class="form-horizontal" role="form" method="POST" action="{{URL::to('admin/pages')}}/{{$page->id}}/update">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PUT">
 



                    <div class="form-group">
                        <label class="col-md-1 control-label">Title</label>
                        <div class="col-md-11">
                            <input type="text" class="form-control" name="title" id="title" value="{{ $page->title }}" autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-1 control-label">Slug</label>
                        <div class="col-md-11">
                            <input type="text" class="form-control" name="slug" id="slug" value="{{ $page->slug}}">
                        </div>
                    </div>
                    
  					<div class="form-group">
                        <label class="col-md-1 control-label">Content</label>
                        <div class="col-md-11">
                            <textarea id="editor" name="content">{{ $page->content }}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-1">
                            <button type="submit" class="btn btn-primary">
                                Update
                            </button>
                            <a href="{{URL::to('admin/pages/')}}" class="btn btn-success">Cancel </a>
                        </div>
                    </div>
                </form>
            
        </div>
    </section>
</div>
<script>
  (function ($) {
		// DONT FORGET TO NAME YOUR PLUGIN
		jQuery.fn.makeSlug = function (options, i) {
			if (this.length > 1) {
				var a = new Array();
				this.each(
					function (i) {
						a.push($(this).makeSlug(options, i));
					});
				return a;
			}
			var opts = $.extend({}, $().makeSlug.defaults, options);
			
			/* PUBLIC FUNCTIONS */
			
			this.destroy = function (reInit) {
				var container = this;
				var reInit = (reInit != undefined) ? reInit : false;
				$(container).removeData('makeSlug'); // this removes the flag so we can re-initialize
			};
			
			this.update = function (options) {
				opts = null;
				opts = $.extend({}, $().makeSlug.defaults, options);
				this.destroy(true);
				return this.init();
			};
			
			this.init = function (iteration) {
				if ($(container).data('makeSlug') == true)
					return this; // this stops double initialization
				
				// call a function before you do anything
				if (opts.beforeCreateFunction != null && $.isFunction(opts.beforeCreateFunction))
					opts.beforeCreateFunction(targetSection, opts);
					
				var container = this; // reference to the object you're manipulating. To jquery it, use $(container). 
				
				$(container).keyup(function(){
					if(opts.slug !== null) opts.slug.val(makeSlug($(this).val()));
				});
				
				$(container).data('makeSlug', true);
				
				// call a function after you've initialized your plugin
				if (opts.afterCreateFunction != null && $.isFunction(opts.afterCreateFunction))
					opts.afterCreateFunction(targetSection, opts);
				return this;
			};
			
			/* PRIVATE FUNCTIONS */
			
			function makeSlug(str) { 
				str = str.replace(/^\s+|\s+$/g, ''); // trim
				str = str.toLowerCase();
				
				// remove accents, swap ס for n, etc
				var from = "אבהגטיכךלםןמעףצפשתüûסח·/_,:;";
				var to   = "aaaaeeeeiiiioooouuuunc------";
				for (var i=0, l=from.length ; i<l ; i++) {
					str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
				}
				
				str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
				.replace(/\s+/g, '-') // collapse whitespace and replace by -
				.replace(/-+/g, '-'); // collapse dashes
				
				return str;
			};
			
			// Finally
			return this.init(i);
		};
	 
		// DONT FORGET TO NAME YOUR DEFAULTS WITH THE SAME NAME
		jQuery.fn.makeSlug.defaults = {
			slug: null,
			beforeCreateFunction: null, // Remember: these are function _references_ not function calls
			afterCreateFunction: null
		};
	})(jQuery);
  $(document).ready(function(){
	    $('#title').makeSlug({
	        slug: $('#slug')
	    });

	    // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace( 'editor' );
        
	});
  </script>
@endsection
