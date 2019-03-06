<div class="row carousel-holder">
    <div class="col-md-12">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @for ($i = 0; $i < count($slide); $i++)
                    @if ($i==0)
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    @else
                    <li data-target="#carousel-example-generic" data-slide-to="{{$i}}"></li>
                    @endif
                   
                @endfor
                
            </ol>
            <div class="carousel-inner">
               @foreach ($slide as $sl)
               <div 
               @if ($loop->first)
               class="item active"
               @else
               class="item"
               @endif
               >
                <img class="slide-image" src="upload/slide/{{$sl->Hinh}}" alt="">
            </div>
               @endforeach
                
            </div>
            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
        </div>
    </div>
</div>