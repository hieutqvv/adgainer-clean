<?php

namespace App\Http\Middleware;

use Closure;
use App\Model\Account;
use App\Http\Controllers\AbstractReportController;
use Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $model = new Account();
        $account_id = !is_null(Auth::user()) ? Auth::user()->account_id : Auth::guard('redisGuard')->user()->account_id;
        if ($model->isAgency($account_id)) {
            session([AbstractReportController::SESSION_KEY_AGENCY_ID => $account_id]);
            return redirect('/client-report');
        } elseif (!$model->isAdmin($account_id)) {
            session([AbstractReportController::SESSION_KEY_CLIENT_ID => $account_id]);
            return redirect('/account_report');
        }
        return $next($request);
    }
}
