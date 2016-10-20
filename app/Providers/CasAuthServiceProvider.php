<?php namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate;
//use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Auth\CasUserProvider;
use Auth;
use App\Api;
use App\Policies\ApiPolicy;
use App\DesignationLog;
use App\Policies\DesignationLogPolicy;
use App\OmsConfigs;
use App\Policies\OmsConfigsPolicy;
use App\Permissions;
use App\Policies\PermissionsPolicy;
use App\Servers;
use App\Policies\ServersPolicy;
use App\TradeWays;
use App\Policies\TradewaysPolicy;
use App\Users;
use App\Policies\UsersPolicy;
use App\Authorizes;
use App\Policies\AuthorizesPolicy;
use App\OgwBranches;
use App\Policies\OgwBranchesPolicy;
use App\OpLogs;
use App\Policies\OpLogsPolicy;
use App\Records;
use App\Policies\RecordsPolicy;
use App\ServerTypes;
use App\Policies\ServertypesPolicy;
use App\TradeWayTypes;
use App\Policies\TradewaytypesPolicy;
use App\UserTradeWays;
use App\Policies\UsertradewaysPolicy;
use App\Branches;
use App\Policies\BranchesPolicy;
use App\OgwConfigs;
use App\Policies\OgwConfigsPolicy;
use App\Orgs;
use App\Policies\OrgsPolicy;
use App\SecuInfo;
use App\Policies\SecuinfoPolicy;
use App\StockLimits;
use App\Policies\StocklimitsPolicy;
use App\User;
use App\Policies\UserPolicy;
use App\Whitelists;
use App\Policies\WhitelistsPolicy;

class CasAuthServiceProvider extends ServiceProvider
{

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Api::class => ApiPolicy::class,
        DesignationLog::class => DesignationLogPolicy::class,
        OmsConfigs::class => OmsConfigsPolicy::class,
        Permissions::class => PermissionsPolicy::class,
        Servers::class => ServersPolicy::class,
        TradeWays::class => TradewaysPolicy::class,
        Users::class => UsersPolicy::class,
        Authorizes::class => AuthorizesPolicy::class,
        OgwBranches::class => OgwBranchesPolicy::class,
        Records::class => RecordsPolicy::class,
        ServerTypes::class => ServertypesPolicy::class,
        TradeWayTypes::class => TradewaytypesPolicy::class,
        UserTradeWays::class => UsertradewaysPolicy::class,
        Branches::class => BranchesPolicy::class,
        OgwConfigs::class => OgwConfigsPolicy::class,
        Orgs::class => OrgsPolicy::class,
        SecuInfo::class => SecuinfoPolicy::class,
        StockLimits::class => StocklimitsPolicy::class,
        Whitelists::class => WhitelistsPolicy::class,
        OpLogs::class => OpLogsPolicy::class
    ];

    /**
     * Bootstrap the provider. Publish configs
     *
     * @return void
     */
    public function boot(Gate $gate)
    {
        $this->registerPolicies($gate);

        Auth::provider('cas', function($app, array $config) {
            // Return an instance of Illuminate\Contracts\Auth\UserProvider...
            return new CasUserProvider($app['cas.connection']);
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
    }


    /**
     * Get the service provider by the provider
     *
     * @return array
     */
    public function provides()
    {
        return [
            'cas'
        ];
    }


}