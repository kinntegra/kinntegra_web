<div class="tab-pane fade show @if(isset($client->accountsdata) && empty($client->accountsdata)) {{'active'}} @endif" id="add-account" role="tabpanel" aria-labelledby="add-tab">
    <div class="form-sections">
        <h4 class="form-section-title text-uppercase">Account Details</h4>
        <div class="addAccountTab row">
            <div class="col-sm-4 first_holder">
                <div class="form-group">
                    <label for="first_holder">First Holder</label>
                    <select class="form-control" id="first_holder" name="first_holder">
                        <option value="" disabled selected>Select First Holder</option>
                        @foreach ($client->client_profiles as $profile)
                            @if($profile->account_type == 1 && $profile->is_account_profile == 1)
                            <option value="{{ $profile->id }}">{{ $profile->name }}</option>
                            @elseif($profile->account_type == 2 && $profile->is_account_profile == 1 && $profile->is_account_holder == false)
                            <option value="{{ $profile->id }}">{{ $profile->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    <input type="hidden" class="form-control" id="first_holder_account_type" name="first_holder_account_type" placeholder="Enter First Holder Name" value="" />
                </div>
            </div>

            <div class="col-sm-4 second_holder">
                <div class="form-group">
                    <label for="second_holder">Second Holder</label>
                    <select class="form-control" id="second_holder" name="second_holder" readonly>
                        <option value="" disabled selected>Select Second Holder</option>
                        @foreach ($client->client_profiles as $profile)
                            @if($profile->account_type == 1 && $profile->is_account_profile == 1 && $profile->age >= 18)
                            <option value="{{ $profile->id }}">{{ $profile->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    {{-- <input type="text" class="form-control" id="second_holder" name="second_holder" placeholder="Enter Second Holder Name" /> --}}
                </div>
            </div>
            <div class="col-sm-4 third_holder">
                <div class="form-group">
                    <label for="third_holder">Third holder</label>

                    <select class="form-control" id="third_holder" name="third_holder" readonly>
                        <option value="" disabled selected>Select Third Holder</option>

                        @foreach ($client->client_profiles as $profile)
                            @if($profile->account_type == 1 && $profile->is_account_profile == 1 && $profile->client_guardian_id == null && $profile->age >= 18)
                            <option value="{{ $profile->id }}">{{ $profile->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    {{-- <input type="text" class="form-control" id="third_holder" name="third_holder" placeholder="Enter Third holder Name" /> --}}
                </div>
            </div>
            <div class="col-sm-4 client_account_type">
                <div class="form-group">
                    <label for="client_account_type"> Account type*</label>
                    <select class="form-control" id="client_account_type" name="client_account_type">
                        <option value="" disabled selected>Select Account type</option>
                        <option value="SINGLE">SINGLE</option>
                        <option value="JOINT">JOINT</option>
                        <option value="ANYONE OR SURVIVOR">ANYONE OR SURVIVOR</option>
                        @if($client->company_member_count > 0)
                        <option value="NON INDIVIDUAL">NON INDIVIDUAL</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="col-sm-12 nominee_detail">
                <div class="form-group custom-checkbox has_nominee" readonly>
                    <input type="checkbox" id="has_nominee" name="has_nominee" class="nominee-checkbox" value="0" readonly>
                    <label for="has_nominee">Nominee?</label>
                </div>
                <div class="form-sections mt-5 mb-0 nominee_set">
                    <h4 class="form-section-title text-uppercase"> NOMINEE DETAILS (Max 3)</h4>
                    <div class="row nominee_1">
                        <div class="col-sm-3 nominee_id_1">
                            <div class="form-group">
                                <label for="nominee_id_1">Nominee Name</label>
                                <select id="nominee_id_1" name="nominee_id_1" class="form-control" readonly>
                                    <option value="" disabled selected>Select Nominee</option>

                                    @foreach ($client->client_profiles as $profile)
                                        @if($profile->account_type == 1)
                                            <option data-age="{{ $profile->age }}" value="{{ $profile->id }}">{{ $profile->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3 nominee_guardian_1">
                            <div class="form-group">
                                <label for="nominee_guardian_1">Guardian Name</label>
                                <select id="nominee_guardian_1" name="nominee_guardian_1" class="form-control" readonly>
                                    <option value="" disabled selected>Select Guardian</option>
                                    @foreach ($client->client_profiles as $profile)
                                        @if($profile->account_type == 1 && $profile->age > 18)
                                            <option value="{{ $profile->id }}">{{ $profile->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3 nominee_relationship_1">
                            <div class="form-group">
                                <label for="nominee_relationship_1">Relationship</label>
                                <select class="form-control" id="nominee_relationship_1" name="nominee_relationship_1" readonly>
                                    <option value="" disabled selected>Select Relationship</option>
                                    @foreach ($relations as $relationship)
                                    <option value="{{ $relationship->name }}">{{ $relationship->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3 nominee_applicable_1">
                            <div class="form-group">
                                <label for="nominee_applicable_1">Applicable</label>
                                <select class="form-control" id="nominee_applicable_1" name="nominee_applicable_1" readonly>
                                    @include('client.percentage', ['val' => '0']);
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row nominee_2">
                        <div class="col-sm-3 nominee_id_2">
                            <div class="form-group">
                                <label for="nominee_id_2">Nominee Name</label>
                                <select id="nominee_id_2" name="nominee_id_2" class="form-control" readonly>
                                    <option value="" disabled selected>Select Nominee</option>
                                    @foreach ($client->client_profiles as $profile)
                                        @if($profile->account_type == 1)
                                            <option data-age="{{ $profile->age }}" value="{{ $profile->id }}">{{ $profile->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3 nominee_guardian_2">
                            <div class="form-group">
                                <label for="nominee_guardian_2">Guardian Name</label>
                                <select id="nominee_guardian_2" name="nominee_guardian_2" class="form-control" readonly>
                                    <option value="" disabled selected>Select Guardian</option>
                                    @foreach ($client->client_profiles as $profile)
                                        @if($profile->account_type == 1 && $profile->age > 18)
                                            <option value="{{ $profile->id }}">{{ $profile->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3 nominee_relationship_2">
                            <div class="form-group">
                                <label for="nominee_relationship_2">Relationship</label>
                                <select class="form-control" id="nominee_relationship_2" name="nominee_relationship_2" readonly>
                                    <option value="" disabled selected>Select Relationship</option>
                                    @foreach ($relations as $relationship)
                                    <option value="{{ $relationship->name }}">{{ $relationship->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3 nominee_applicable_2">
                            <div class="form-group">
                                <label for="nominee_applicable_2">Applicable</label>
                                <select class="form-control" id="nominee_applicable_2" name="nominee_applicable_2" readonly>
                                    @include('client.percentage', ['val' => ''])
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row nominee_3">
                        <div class="col-sm-3 nominee_id_3">
                            <div class="form-group">
                                <label for="nominee_id_3">Nominee Name</label>
                                <select id="nominee_id_3" name="nominee_id_3" class="form-control" readonly>
                                    <option value="" disabled selected>Select Nominee</option>
                                    @foreach ($client->client_profiles as $profile)
                                        @if($profile->account_type == 1 && $profile->age > 18)
                                            <option data-age="{{ $profile->age }}" value="{{ $profile->id }}">{{ $profile->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3 nominee_guardian_3">
                            <div class="form-group">
                                <label for="nominee_guardian_3">Guardian Name</label>
                                <select id="nominee_guardian_3" name="nominee_guardian_3" class="form-control" readonly>
                                    <option value="" disabled selected>Select Guardian</option>
                                    @foreach ($client->client_profiles as $profile)
                                        @if($profile->account_type == 1)
                                            <option value="{{ $profile->id }}">{{ $profile->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3 nominee_relationship_3">
                            <div class="form-group">
                                <label for="nominee_relationship_3">Relationship</label>
                                <select class="form-control" id="nominee_relationship_3" name="nominee_relationship_3" readonly>
                                    <option value="" disabled selected>Select Relationship</option>
                                    @foreach ($relations as $relationship)
                                    <option value="{{ $relationship->name }}">{{ $relationship->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3 nominee_applicable_3">
                            <div class="form-group">
                                <label for="nominee_applicable_3">Applicable</label>
                                <select class="form-control" id="nominee_applicable_3" name="nominee_applicable_3" readonly>
                                    @include('client.percentage', ['val' => ''])
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 bank_detail">
                <div class="form-sections">
                    <h4 class="form-section-title text-uppercase">Bank Details</h4>
                    <div class="row">
                        <div class="col-sm-4 default_bank">
                            <div class="form-group">
                                <label for="default_bank"> Default Bank</label>
                                <select id="default_bank" name="default_bank" class="form-control" readonly>
                                    <option value="" disabled selected>Select Default Bank</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4 other_bank" id="other_bank_detail">
                            <div class="form-group">
                                <label for="other_bank">Other Bank</label>
                                <div class="dropdown customMulti" readonly>
                                    <a class="dropdown-toggle select-dropdown" type="button" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false"><span class="text-grey">Select Other bank</span></a>
                                    <div id="other_bank" class="dropdown-menu dropdown-menu-left select-dropdown-list">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
