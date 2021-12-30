<section class="u-clearfix u-palette-1-base u-section-3" id="carousel_a971">
      <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
        <div class="u-clearfix u-expanded-width u-layout-wrap u-layout-wrap-1">
          <div class="u-gutter-0 u-layout">
            <div class="u-layout-row">
              <div class="u-align-left-md u-align-left-sm u-align-left-xs u-container-style u-layout-cell u-size-20 u-layout-cell-1">
                <div class="u-container-layout u-valign-top u-container-layout-1">
                  <!-- <h4 class="u-align-left-lg u-align-left-xl u-text u-text-palette-1-light-2 u-text-1">my skills</h4> -->
                  <h1 class="u-text u-text-2">Experience<br> True<br> Professionalism  </h1>
                 <!--  <p class="u-align-left-lg u-align-left-xl u-text u-text-palette-1-light-2 u-text-3">We specialize in CCTV camera installations, security gate installation, software development.</p> -->
                  <!-- <a href="https://nicepage.app" class="u-active-white u-btn u-btn-round u-button-style u-hover-white u-palette-3-base u-radius-8 u-text-active-palette-3-base u-text-body-alt-color u-text-hover-palette-3-base u-btn-1">resume&nbsp;&nbsp;<span class="u-icon u-icon-1"><svg class="u-svg-content" viewBox="-16 0 384 384" style="width: 1em; height: 1em;"><path d="m256 0h-256v384h32v-352h192v96h96v256h32v-302.625l-81.375-81.375zm64 96h-64v-64h1.375l62.625 62.625zm0 0"></path><path d="m68.808594 254.832031 196.457031-46.222656-127.121094-115.554687zm129.933594-63.441406-75.542969 17.777344 26.664062-62.214844zm0 0"></path><path d="m64 288h224v32h-224zm0 0"></path><path d="m64 352h176v32h-176zm0 0"></path></svg><img></span>
                  </a> -->
                </div>
              </div>
              <div class="u-container-style u-layout-cell u-size-20 u-layout-cell-2">
                <div class="u-container-layout u-valign-top u-container-layout-2">
                  <ul class="u-align-left u-custom-list u-text u-text-palette-1-light-2 u-text-4">
                    @foreach($data['services_f'] as $i=>$service)
                      @if($i<3)
                    <li>
                      <div class="u-list-icon">
                        <div xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" xml:space="preserve" class="u-svg-content">—</div>
                      </div>{{ $service->service_name }}
                    </li>
                      @endif
                    @endforeach
                  </ul>
                </div>
              </div>
              <div class="u-container-style u-layout-cell u-size-20 u-layout-cell-3">
                <div class="u-container-layout u-valign-top u-container-layout-3">
                  <ul class="u-align-left u-custom-list u-text u-text-palette-1-light-2 u-text-5">
                    @foreach($data['services_f'] as $i=>$service)
                      @if($i>2)
                    <li>
                      <div class="u-list-icon">
                        <div xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" xml:space="preserve" class="u-svg-content">—</div>
                      </div>{{ $service->service_name }}
                    </li>
                      @endif
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>