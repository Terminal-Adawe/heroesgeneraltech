<section class="u-align-center u-clearfix u-section-2" id="carousel_a59b">
      <div class="u-clearfix u-sheet u-sheet-1">
        <img class="u-image u-image-default u-image-1" src="{{ asset('images/cctv2.jpg') }}" alt="" data-image-width="150" data-image-height="97" data-aos="fade-in" data-aos-easing="ease-in-out">
        <div class="u-clearfix u-expanded-width u-layout-wrap u-layout-wrap-1">
          <div class="u-layout">
            <div class="u-layout-row">
              <div class="u-align-left u-container-style u-layout-cell u-size-37 u-layout-cell-1">
                <div class="u-container-layout u-valign-middle u-container-layout-1">
                  <h4 class="u-text u-text-1">About Us</h4>
                  <p class="u-text u-text-2">Heroes General Tech has been established for more than 7 years and has been providing security and safety solutions to families and businessses particularly into a broad range of industries covering household and industrial.</p>
                  <!-- <p class="u-text u-text-3">Sample text. Click to select the text box. Click again or double click to start editing the text.</p> -->
                </div>
              </div>
              <div class="u-container-style u-layout-cell u-size-23 u-layout-cell-2">
                <div class="u-container-layout u-valign-middle u-container-layout-2">
                  <ul class="u-custom-list u-text u-text-default u-text-4">
                    @foreach($data['services_f'] as $service)
                    <li style="">
                      <div class="u-list-icon u-text-palette-3-base">
                        <svg class="u-svg-content" viewBox="0 0 512 512" id="svg-ac83"><path d="m433.1 67.1-231.8 231.9c-6.2 6.2-16.4 6.2-22.6 0l-99.8-99.8-78.9 78.8 150.5 150.5c10.5 10.5 24.6 16.3 39.4 16.3 14.8 0 29-5.9 39.4-16.3l282.7-282.5z" fill="currentColor"></path></svg>
                      </div>{{ $service->service_name }}&nbsp;
                    </li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>