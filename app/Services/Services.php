<?php

namespace App\Services;

use App\Traits\AuthorizesMarketRequests;
use App\Traits\ConsumeExternalServices;
use App\Traits\InteractsWithMarketResponses;
use App\Traits\ManageAssociate;
use App\Traits\ManageBanks;
use App\Traits\ManageExternal;
use App\Traits\ManageLeads;
use App\Traits\ManageMaster;
use App\Traits\ManageTradeLog;
use App\Traits\ManageTransaction;

class Services
{
    use ConsumeExternalServices, AuthorizesMarketRequests, InteractsWithMarketResponses, ManageAssociate, ManageBanks, ManageMaster, ManageExternal, ManageLeads, ManageTransaction, ManageTradeLog;
}
