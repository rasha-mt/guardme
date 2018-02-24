@extends('jobs::layouts.new-job')

@section('new-job')
   <div class="row">
      <div class="col-sm-4">
         <div class="row">
            <div class="col-sm-12">
               <div class="ui ordered vertical steps">
                  <div :class="[{'active' : step == 1}, 'step']">
                     <div class="content">
                        <div class="title">Create Job</div>
                        <div class="description">Provide information for the new job</div>
                     </div>
                  </div>
                  <div :class="[{'active' : step == 2}, 'step']">
                     <div class="content">
                        <div class="title">Publish</div>
                        <div class="description">Choose who will see this job</div>
                     </div>
                  </div>

                  <div class="step">
                     <div class="content">
                        <div class="title">Payment</div>
                        <div class="description">Determine who to publish this to</div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-sm-12 mt-5">
               <google-map name="location_preview" :height="500"
                :markers="[{latitude: job.address.coord.latt, longitude: job.address.coord.long}]">
               </google-map>
            </div>
         </div>
      </div>

      <!-- PAGE 1 -->
      <div class="col-sm-6" v-show="step == 1">
         <form class="ui form" @submit.prevent="validateForm('new-job-form')" data-vv-scope="new-job-form">
            <div class="field">
               <label>Choose your company/organization:</label>

               <div :class="[{'loading' : counties.loading},'ui selection search dropdown fluid company']">
                  <input type="text" name="company" v-model="job.company" v-validate="'required'">
                  <i class="dropdown icon"></i>
                  <div class="default text">Pick from list...</div>
                  <div class="menu">
                     <div class="item" :data-value="company.id" v-for="company in companies.data">
                        @{{ company.name }}
                     </div>
                     <div class="item" v-if="!companies.data.length">
                        No companies found
                     </div>
                     <div class="item" data-value="new">
                        <i class="icon add circle"></i> Add Company
                     </div>
                  </div>
               </div>
               <span v-show="errors.has('new-job-form.company')" class="d-inline-block uk-text-small uk-text-danger">
                                @{{ errors.first('new-job-form.company') }}
                             </span>
            </div>

            <div :class="[{error : errors.has('new-job-form.title')}, 'field my-4']">
               <label>Job title:</label>
               <input type="text" name="title" v-model="job.title"
                      placeholder="The title of the job:"
                      v-validate="'required'">
               <span v-show="errors.has('new-job-form.title')" class="d-inline-block uk-text-small uk-text-danger">
                 @{{ errors.first('new-job-form.title') }}
               </span>
            </div>

            <div :class="[{error : errors.has('new-job-form.description')}, 'field my-4']">
               <label>Job description:</label>
               <textarea placeholder="Enter a brief job description" name="description"
                         v-validate="'required'"
                         v-model="job.description"></textarea>
               <span v-show="errors.has('new-job-form.description')"
                     class="d-inline-block uk-text-small uk-text-danger">
                 @{{ errors.first('new-job-form.description') }}
               </span>
            </div>

            <div class="field my-4">
               <label>Address:</label>
               {{--<input type="text" name="address" placeholder="Address Line 1:"
                      v-model="job.address">--}}
               <div class="">
                  <p class="p-0 m-0 uk-text-small" v-if="job.address.line1.length">@{{ job.address.line1 }},</p>
                  <p class="p-0 m-0 uk-text-small" v-if="job.address.line2.length">@{{ job.address.line2 }},</p>
                  <p class="p-0 m-0 uk-text-small" v-if="job.address.city.length">@{{ job.address.city }},</p>
                  <p class="p-0 m-0 uk-text-small" v-if="job.address.county.length">@{{ job.address.county }}</p>
               </div>
               <div class="row p-0 mx-0 my-1">
                  {{--<div class="col-5 p-0">
                     <div :class="[{'loading' : counties.loading},'ui selection search dropdown fluid counties']">
                        <input type="text" name="county" v-model="job.county">
                        <i class="dropdown icon"></i>
                        <div class="default text">Choose county</div>
                        <div class="menu">
                           <div class="item" :data-value="county.id" v-for="county in counties.data">
                              @{{ county.name }}
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-6 p-0">
                     <div :class="[{'loading disabled' : cities.loading, 'disabled' : !cities.data.length},
                     'ui selection search dropdown fluid cities']">
                        <input type="hidden" name="job.city" v-model="job.city">
                        <i class="dropdown icon"></i>
                        <div class="default text">Select city:</div>
                        <div class="menu">
                           <div class="item" :data-value="city.id" v-for="city in cities.data">
                              @{{ city.name }}
                           </div>
                        </div>
                     </div>
                  </div>--}}

                  <div class="col-4 p-0">
                     <input type="text" class="fluid" name="postcode" v-model.lazy="job.postcode"
                            placeholder="Postcode:">
                  </div>
                  <div class="col-4 p-0 offset-1">
                     <input type="text" class="fluid" name="house_number" v-model="job.address.houseNumber"
                            placeholder="House Number:">
                  </div>
               </div>
            </div>

            <div class="field">
               <label>Category: <small class="uk-text-meta">(Choose all that apply)</small></label>
               <div class="fluid d-flex justify-content-between row">
                  <div class="inline field col-6" v-for="category in categories.data">
                     <div class="ui checkbox">
                        <input type="checkbox" :value="category.id" name="job.categories"
                               v-model="job.categories" tabindex="0" class="hidden">
                        <label>@{{ category.name }}</label>
                     </div>
                  </div>
               </div>
            </div>

            <div class="field my-4">
               <label>Sectors: <small class="uk-text-meta">(Choose all that apply)</small></label>
               <div class="fluid d-flex justify-content-between row">
                  <div class="inline field col-6" v-for="sector in sectors.data">
                     <div class="ui checkbox">
                        <input type="checkbox" :value="sector.id" name="job.sectors"
                               v-model="job.sectors" tabindex="0" class="hidden">
                        <label>@{{ sector.name }}</label>
                     </div>
                  </div>
               </div>
            </div>

            <button class="ui button primary mini" type="submit">Continue  <i class="icon arrow right circle"></i></button>
         </form>
      </div>

      <!-- PAGE 2 -->
      <div class="col-sm-6" v-show="step == 2">
         <form class="ui form" @submit.prevent="validateFinishForm('finish-job-form')" data-vv-scope="finish-job-form">

            <div class="field">
               <label>Broadcasts to: <small class="uk-text-meta">(Choose all that apply)</small></label>
               <div class="fluid d-flex justify-content-between row">
                  <div class="inline field col-6" v-for="(config, key) in broadcastsConfig.data">
                     <div class="ui checkbox">
                        <input type="checkbox" :value="key" name="job.broadcastsConfig"
                               v-model="job.broadcastsConfig" tabindex="0" class="hidden">
                        <label>@{{ config }}</label>
                     </div>
                  </div>
               </div>
            </div>

            <div class="row p-0 mx-0 my-1 d-flex justify-content-between">
               <div class="col-5 p-0">
                  <div class="field fluid timepicker my-4">
                     <label>Start Time:</label>
                     <input type="text" id="time_starts" name="time_start" v-model="job.time.start"
                            data-toggle="datetimepicker" data-target="#time_starts" class="time-picker"
                            placeholder="Start time:">
                  </div>
               </div>
               <div class="col-sm-2 uk-text-center my-4">
                  &mdash;
               </div>
               <div class="col-5 p-0">
                  <div class="field my-4">
                     <label>End Time:</label>
                     <input type="text" name="time_end" class="time-picker" id="time_ends"
                            data-toggle="datetimepicker" data-target="#time_ends"
                            v-model="job.time.end" placeholder="End time:">
                  </div>

               </div>
            </div>

            <div class="row p-0 mx-0 my-4 d-flex justify-content-between">
               <div class="col-7 p-0 field">
                  <label>SIA staff rating:</label>
                  <div class="fluid d-block">
                     <div class="ui star rating sia_staff_rating float-none" data-max-rating="5"></div>
                  </div>
                  <span class="d-block p-0 fluid m-0 uk-text-meta">
                       @{{ ratingMessage }}
                  </span>
               </div>
               <div class="col-4 p-0 field">
                  <label>Offer (£):</label>

                  <div class="ui input fluid">
                     <input type="text" name="wage" placeholder="£ 8.00" v-model="job.wages">
                  </div>
               </div>
            </div>

            <div class="field">
               <button class="ui button secondary mini" type="button" @click="previous()">Previous</button>
               <button class="ui button primary mini" type="submit">Submit <i class="icon check"></i></button>
            </div>
         </form>

      </div>
   </div>

   <div class="ui modal small" style="bottom: unset;">
      <div class="header">Add New Company / Organization</div>
      <div class="content">
         <form @submit.prevent="validateNewCompanyForm('new-company-form')"
               :class="[{'loading' : company.saving}, 'ui form']"
               data-vv-scope="new-company-form">
            <div :class="[{error : errors.has('new-company-form.company_name')}, 'field my-4']">
               <label>Name of company / organization:</label>
               <input type="text" name="company_name" v-model="company.data.name"
                      placeholder="Your company name:"
                      v-validate="'required'">
               <span v-show="errors.has('new-company-form.company_name')"
                     class="d-inline-block uk-text-small uk-text-danger">
                 @{{ errors.first('new-company-form.company_name') }}
              </span>
            </div>

            <div :class="[{error : errors.has('new-company-form.address')}, 'field my-4']">
               <label>Company address:</label>
               <textarea placeholder="Corporate address" name="address"
                         v-validate="'required'"
                         v-model="company.data.address"></textarea>
               <span v-show="errors.has('new-company-form.address')"
                     class="d-inline-block uk-text-small uk-text-danger">
                 @{{ errors.first('new-company-form.address') }}
               </span>
            </div>

            <div class="field my-4">
               <div class="row p-0 mx-0 my-1 d-flex justify-content-between">
                  <div class="p-0 pr-1 col-6">
                     <div :class="[{error : errors.has('new-company-form.company_email')}, 'field my-4']">
                        <label>Corporate Email:</label>
                        <input type="text" name="company_email" v-model="company.data.email"
                               placeholder="Your company email:"
                               v-validate="'required|email'">
                        <span v-show="errors.has('new-company-form.company_email')"
                              class="d-inline-block uk-text-small uk-text-danger">
                             @{{ errors.first('new-company-form.company_email') }}
                     </span>
                     </div>
                  </div>

                  <div class="p-0 pl-1 col-6">
                     <div :class="[{error : errors.has('new-company-form.company_phone')}, 'field my-4']">
                        <label>Corporate Phone:</label>
                        <input type="text" name="company_phone" v-model="company.data.phone"
                               placeholder="Your company phone:"
                               v-validate="'required'">
                        <span v-show="errors.has('new-company-form.company_phone')"
                              class="d-inline-block uk-text-small uk-text-danger">
                             @{{ errors.first('new-company-form.company_phone') }}
                     </span>
                     </div>
                  </div>
               </div>
            </div>

            <div class="field my-4">
               <button class="ui button primary float-none mini" type="submit">Create <i class="icon check circle"></i></button>
            </div>
         </form>
      </div>
   </div>
@endsection

@push('styles')
   <link rel="stylesheet" href="/vendors/font-awesome/css/font-awesome.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
@endpush

@push('scripts')
   <script src="/vendors/moments/moment-with-locales.js"></script>
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>

@endpush