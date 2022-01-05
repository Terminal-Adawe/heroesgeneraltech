<div class="row" style="margin-top: 80px;">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-12"></div>
            <div class="col-md-4 col-sm-12"></div>
            <div class="col-md-4 col-sm-12">
                <h1 data-aos="fade-left" data-aos-duration="1500" data-aos-offset="500" data-aos-once="true">{{ $data['service_details']->service_name }}</h1>
            </div>
            <hr>
        </div>

        <div class="row">
            <div class="col-12">
                {{ $data['service_details']->service_description }}
            </div>
            <div class="col-md-7 col-sm-12 mt-4">
            </div>
            <div class="col-md-5 col-sm-12 mt-4">
                <h2>Features</h2>
                @foreach($data['features'] as $feature)
                <span data-aos="fade-left" data-aos-delay="50">{{ $feature->service_feature_name }}</span>
                <p>
                    {{ $feature->service_feature_description }}
                </p>
                @endforeach
            </div>
        </div>
    </div>
</div>