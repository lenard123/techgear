<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="description" content="Page not found">
  <title>Error 404: Page not found</title>
  <link rel="icon" type="image/jpeg" href="<?= url('assets/img/favicon.ico') ?>" /> 
  <link rel="stylesheet" type="text/css" href="<?= url('assets/css/tailwind.css') ?>">
</head>
<body>

<section class="flex items-center justify-center h-full p-24 bg-coolGray-50 text-coolGray-800">
	
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4">
		
    <div class="col-span-3">

      <h2 class="mb-8 font-bold text-8xl text-blue-600">
				<span class="sr-only">Error</span>404
			</h2>

			<p class="text-2xl font-semibold md:text-3xl">Sorry, we couldn't find this page.</p>
			<p class="mt-4 mb-8 text-coolGray-600">Please check the URL in the address bar and try again</p>
			
      <a href="<?= url() ?>" class="font-semibold rounded bg-violet-600 text-coolGray-50">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
          Back to Home Page.
        </button>
      </a>

		</div>

    <div>
      <img
        src="<?= url('assets/img/404.png') ?>"
        class="sm:py-20 md:py-10" 
      />
    </div>

	</div>

</section>

</body>
</html>
