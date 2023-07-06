<div class="container mt-5 text-center" x-data="{
   
}">

    <x-centralizar>

        <div class="row justify-content-center mb-3">
            <div class="col-lg-7 col-md-8 col-sm-10">
                <x-icon.logo></x-icon.logo>
            </div>
        </div>

        <div class="row justify-content-center mb-5">
            <div class="col-md-6 col-sm-10 col-11">
                <p class="fs-5">{{$paragrafo}}</p>
            </div>
        </div>

        <div class="row justify-content-center mb-5">
            <div class="col-md-4 col-sm-6 col-9">
                <a href="{{$rota}}" class="btn btn-lg btn-primary w-100 py-3">{{$btn}}</a>
            </div>
        </div>

    </x-centralizar>

</div>