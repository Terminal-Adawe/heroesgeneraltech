<section class="u-clearfix u-image u-shading u-section-4" id="carousel_688b" data-image-width="1618" data-image-height="1080">
      <div class="u-clearfix u-sheet u-sheet-1">
        <div class="u-clearfix u-expanded-width u-layout-wrap u-layout-wrap-1">
          <div class="u-layout">
            <div class="u-layout-row">
              <div class="u-container-style u-layout-cell u-left-cell u-size-34 u-layout-cell-1">
                <div class="u-container-layout u-container-layout-1">
                  <h2 class="u-subtitle u-text u-text-body-color u-text-default u-text-1">Ongoing projects</h2>
                  <div data-interval="5000" data-u-ride="carousel" class="u-carousel u-slider u-slider-1" id="carousel-d4d4">
                    <ol class="u-absolute-hcenter u-carousel-indicators u-carousel-indicators-1">
                      <li data-u-target="#carousel-d4d4" class="u-active u-grey-30" data-u-slide-to="0"></li>
                      <li data-u-target="#carousel-d4d4" class="u-grey-30" data-u-slide-to="1"></li>
                    </ol>
                    <div class="u-carousel-inner" role="listbox">
                      @foreach($data['projects'] as $i=>$project)
                      <div class="u-active u-carousel-item u-container-style u-slide">
                        <div class="u-container-layout u-valign-bottom u-container-layout-2">
                          <div class="fr-view u-clearfix u-rich-text u-text u-text-2">
                            <h1>
                              <span class="u-text-body-color">{{ $project->service_name }}</span><small style="color: #aeb6bf;">{{ $project->stage }}</small>
                            </h1>
                            <p>
                              <span class="u-text-body-color">{{ $project->comment }}</span>
                            </p>
                            <p>
                              <ul>
                                @foreach($data['service_features'] as $feature)
                                  @if($feature->service_id == $project->service_id)
                                    <li>{{ $feature->service_feature_name }}</li>
                                  @endif
                                @endforeach
                              </ul>
                            </p>
                          </div>
                        </div>
                      </div>
                      @endforeach
                    </div>
                    <a class="u-absolute-vcenter u-carousel-control u-carousel-control-prev u-spacing-5 u-text-grey-30 u-carousel-control-1" href="#carousel-d4d4" role="button" data-u-slide="prev">
                      <span aria-hidden="true">
                        <svg viewBox="0 0 477.175 477.175"><path d="M145.188,238.575l215.5-215.5c5.3-5.3,5.3-13.8,0-19.1s-13.8-5.3-19.1,0l-225.1,225.1c-5.3,5.3-5.3,13.8,0,19.1l225.1,225
                    c2.6,2.6,6.1,4,9.5,4s6.9-1.3,9.5-4c5.3-5.3,5.3-13.8,0-19.1L145.188,238.575z"></path></svg>
                      </span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="u-absolute-vcenter u-carousel-control u-carousel-control-next u-spacing-5 u-text-grey-30 u-carousel-control-2" href="#carousel-d4d4" role="button" data-u-slide="next">
                      <span aria-hidden="true">
                        <svg viewBox="0 0 477.175 477.175"><path d="M360.731,229.075l-225.1-225.1c-5.3-5.3-13.8-5.3-19.1,0s-5.3,13.8,0,19.1l215.5,215.5l-215.5,215.5
                    c-5.3,5.3-5.3,13.8,0,19.1c2.6,2.6,6.1,4,9.5,4c3.4,0,6.9-1.3,9.5-4l225.1-225.1C365.931,242.875,365.931,234.275,360.731,229.075z"></path></svg>
                      </span>
                      <span class="sr-only">Next</span>
                    </a>
                  </div>
                </div>
              </div>
              <div class="u-align-right u-container-style u-layout-cell u-right-cell u-size-26 u-layout-cell-2">
                <div class="u-container-layout u-container-layout-4">
                  <div class="u-image u-image-circle u-image-1" alt="" data-image-width="700" data-image-height="794"></div>
                  <ul class="u-custom-list u-text u-text-3">
                    <li>
                      <div class="u-list-icon u-list-icon-1">
                        <svg class="u-svg-content" viewBox="0 0 24 24" id="svg-0da7"><path d="m23.526 5.101c-.04-.399-.231-.759-.541-1.014l-2.318-1.904c-.639-.524-1.585-.432-2.111.207l-9.745 11.86-3.916-3.355c-.628-.536-1.576-.465-2.115.163l-1.952 2.278c-.261.304-.388.691-.357 1.091s.215.764.52 1.024l7.403 6.346c.275.235.616.361.974.361.044 0 .089-.002.134-.006.405-.036.77-.229 1.028-.542l12.662-15.411c.255-.309.373-.7.334-1.098z" fill="#2196f3"></path><path d="m.638 13.173c-.304.354-.452.807-.417 1.273.036.466.251.891.606 1.194l7.403 6.346v.001c.321.273.719.421 1.136.421.052 0 .104-.003.156-.007.472-.042.898-.266 1.199-.632l12.665-15.411c.613-.746.504-1.852-.242-2.464l-2.318-1.904c-.744-.612-1.848-.504-2.463.24l-9.584 11.665-3.722-3.189c-.732-.627-1.839-.543-2.467.189zm3.444-1.329 4.303 3.688c.153.131.348.196.554.178.201-.018.386-.115.514-.271l10.07-12.255c.087-.107.246-.123.352-.035l2.318 1.904c.107.088.123.246.035.353l-12.664 15.41c-.058.07-.132.087-.171.09-.039.006-.115.001-.185-.059l-7.404-6.346c-.068-.059-.083-.132-.086-.171-.003-.038.001-.113.06-.182l1.952-2.278c.089-.102.247-.116.352-.026z"></path></svg>
                      </div>Sample Item 1
                    </li>
                    <li>
                      <div class="u-list-icon u-list-icon-2">
                        <svg class="u-svg-content" viewBox="0 0 24 24" id="svg-0da7"><path d="m23.526 5.101c-.04-.399-.231-.759-.541-1.014l-2.318-1.904c-.639-.524-1.585-.432-2.111.207l-9.745 11.86-3.916-3.355c-.628-.536-1.576-.465-2.115.163l-1.952 2.278c-.261.304-.388.691-.357 1.091s.215.764.52 1.024l7.403 6.346c.275.235.616.361.974.361.044 0 .089-.002.134-.006.405-.036.77-.229 1.028-.542l12.662-15.411c.255-.309.373-.7.334-1.098z" fill="#2196f3"></path><path d="m.638 13.173c-.304.354-.452.807-.417 1.273.036.466.251.891.606 1.194l7.403 6.346v.001c.321.273.719.421 1.136.421.052 0 .104-.003.156-.007.472-.042.898-.266 1.199-.632l12.665-15.411c.613-.746.504-1.852-.242-2.464l-2.318-1.904c-.744-.612-1.848-.504-2.463.24l-9.584 11.665-3.722-3.189c-.732-.627-1.839-.543-2.467.189zm3.444-1.329 4.303 3.688c.153.131.348.196.554.178.201-.018.386-.115.514-.271l10.07-12.255c.087-.107.246-.123.352-.035l2.318 1.904c.107.088.123.246.035.353l-12.664 15.41c-.058.07-.132.087-.171.09-.039.006-.115.001-.185-.059l-7.404-6.346c-.068-.059-.083-.132-.086-.171-.003-.038.001-.113.06-.182l1.952-2.278c.089-.102.247-.116.352-.026z"></path></svg>
                      </div>Sample Item 2
                    </li>
                    <li>
                      <div class="u-list-icon u-list-icon-3">
                        <svg class="u-svg-content" viewBox="0 0 24 24" id="svg-0da7"><path d="m23.526 5.101c-.04-.399-.231-.759-.541-1.014l-2.318-1.904c-.639-.524-1.585-.432-2.111.207l-9.745 11.86-3.916-3.355c-.628-.536-1.576-.465-2.115.163l-1.952 2.278c-.261.304-.388.691-.357 1.091s.215.764.52 1.024l7.403 6.346c.275.235.616.361.974.361.044 0 .089-.002.134-.006.405-.036.77-.229 1.028-.542l12.662-15.411c.255-.309.373-.7.334-1.098z" fill="#2196f3"></path><path d="m.638 13.173c-.304.354-.452.807-.417 1.273.036.466.251.891.606 1.194l7.403 6.346v.001c.321.273.719.421 1.136.421.052 0 .104-.003.156-.007.472-.042.898-.266 1.199-.632l12.665-15.411c.613-.746.504-1.852-.242-2.464l-2.318-1.904c-.744-.612-1.848-.504-2.463.24l-9.584 11.665-3.722-3.189c-.732-.627-1.839-.543-2.467.189zm3.444-1.329 4.303 3.688c.153.131.348.196.554.178.201-.018.386-.115.514-.271l10.07-12.255c.087-.107.246-.123.352-.035l2.318 1.904c.107.088.123.246.035.353l-12.664 15.41c-.058.07-.132.087-.171.09-.039.006-.115.001-.185-.059l-7.404-6.346c-.068-.059-.083-.132-.086-.171-.003-.038.001-.113.06-.182l1.952-2.278c.089-.102.247-.116.352-.026z"></path></svg>
                      </div>Sample Item 3
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>