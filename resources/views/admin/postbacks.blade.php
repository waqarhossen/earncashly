<x-admin-layout>
    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <div class="flex items-center space-x-4 py-5 lg:py-6">
            <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">

            </h2>
        </div>


        <div class="card col-span-12 pb-4 sm:col-span-6">
            <div
                class="flex flex-col items-center space-y-4 border-b border-slate-200 p-4 dark:border-navy-500 sm:flex-row sm:justify-between sm:space-y-0 sm:px-5">
                <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                    Postbacks
                </h2>
                <div class="flex justify-center space-x-2">

                </div>
            </div>
            <div class="p-4 sm:p-5">

                <div>

                    <div class=" grid-cols-1 gap-2 sm:grid-cols-2">

                        <label class="block">
                            <span>AdGem Postback url</span>
                            <div class="flex items-center gap-3">
                                <input
                                    class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400
                                    focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    type="url" value="{{ url('/api/adgem?player_id={player_id}&amount={amount}&campaign_name={campaign_name}&campaign_id={campaign_id}&payout={payout}&ip={ip}&platform={platform}&device={device}&transaction_id={transaction_id}&device_name={device_name}&conversion_datetime={conversion_datetime}&click_datetime={click_datetime}') }}">
                            </div>
                        </label>

                        <label class="block mt-3">
                            <span>AdGetMedia Postback url</span>
                            <div class="flex items-center gap-3">
                                <input
                                    class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400
                                    focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    type="url" value="{{ url('/api/adget/?conversion_id={conversion_id}&user_id={s1}&point_value={points}&usd_value={payout}&offer_title={vc_title}') }}">
                            </div>
                        </label>

                        <label class="block mt-3">
                            <span>OfferToro Postback url</span>
                            <div class="flex items-center gap-3">
                                <input
                                    class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400
                                    focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    type="url" value="{{ url('/api/offertoro/?user_id={user_id}&amount={amount}&o_name={o_name}&oid={oid}&payout={payout}&ip_address={ip_address}&event={event}&conversion_ts={conversion_ts}') }}">
                            </div>
                        </label>

                        <label class="block mt-3">
                            <span>CPA Lead Postback url</span>
                            <div class="flex items-center gap-3">
                                <input
                                    class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400
                                    focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    type="url" value="{{ url('/api/cpalead/?subid={subid}&virtual_currency={virtual_currency}&password={password}') }}">
                            </div>
                        </label>

                        <label class="block mt-3">
                            <span>ayeTstudios Postback url</span>
                            <div class="flex items-center gap-3">
                                <input
                                    class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400
                                    focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    type="url" value="{{ url('/api/ayet/?external_identifier={external_identifier}&currency_amount={currency_amount}&offer_name={offer_name}&offer_id={offer_id}&payout_usd={payout_usd}&ip={ip}&transaction_id={transaction_id}&user_id={user_id}&is_chargeback={is_chargeback}&device_uuid={device_uuid}&device_model={device_model}') }}">
                            </div>
                        </label>

                        <label class="block mt-3">
                            <span>Bitlab Postback url</span>
                            <div class="flex items-center gap-3">
                                <input
                                    class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400
                                    focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    type="url" value="{{ url('/api/bitlab/?uid=[%UID%]&amount=[%VAL%]&offer_name=[%OFFER_NAME%]&offer_id=[%OFFER_ID%]&payout=[%RAW%]&ip_address=[%VAL%]&trans_id=[%TX%]&country=[%COUNTRY%]&s_minuts=[%LOI%]&type=[%TYPE%]&task_id=[%TASK_ID%]&pre_ref=[%EVT%]') }}">
                            </div>
                        </label>

                        <label class="block mt-3">
                            <span>CPXResearch Postback url</span>
                            <div class="flex items-center gap-3">
                                <input
                                    class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400
                                    focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    type="url" value="{{ url('/api/cpxr/?trans_id={trans_id}&status={status}&user_id={user_id}&amount_local={amount_local}&offer_ID={offer_ID}&amount_usd={amount_usd}&ip_click={ip_click}&secure_hash={secure_hash}') }}">
                            </div>
                        </label>

                        <label class="block mt-3">
                            <span>Inbrain Postback url</span>
                            <div class="flex items-center gap-3">
                                <input
                                    class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400
                                    focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    type="url" value="{{ url('/api/inbrain') }}">
                            </div>
                        </label>

                        <label class="block mt-3">
                            <span>MMWall Postback url</span>
                            <div class="flex items-center gap-3">
                                <input
                                    class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400
                                    focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    type="url" value="{{ url('/api/mmwall') }}">
                            </div>
                        </label>

                        <label class="block mt-3">
                            <span>Wannads Postback url</span>
                            <div class="flex items-center gap-3">
                                <input
                                    class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400
                                    focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    type="url" value="{{ url('/api/wann?uid={user_id}&transaction_id={transaction_id}&payout={payout}&point_value={reward}&ip={ip}&type={status}&oname={offer_name}&oid={offer_id}&signature={signature}') }}">
                            </div>
                        </label>
                        
                        <label class="block mt-3">
                            <span>Monlix Postback url</span>
                            <div class="flex items-center gap-3">
                                <input
                                    class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400
                                    focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    type="url" value="{{ url('/') }}@php echo "/api/monli?trans_id={{transactionId}}&status={{status}}&user_id={{userId}}&point_value={{rewardValue}}&oid={{transactionId}}&payout={{payout}}&ip_click={userIp}&secretKey={{secretKey}}" @endphp">
                            </div>
                        </label>                        
                        
                        <label class="block mt-3">
                            <span>Revlum Postback url</span>
                            <div class="flex items-center gap-3">
                                <input
                                    class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400
                                    focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    type="url" value="{{ url('/') }}@php echo "/api/revlum?subId={subId}&reward={reward}&offerId={offerId}&offerName={offerName}&payout={payout}&transId={transId}&userIp={userIp}&country={country}&signature={signature}" @endphp">
                            </div>
                        </label>
                        
                        <label class="block mt-3">
                            <span>Lootably Postback url</span>
                            <div class="flex items-center gap-3">
                                <input
                                    class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400
                                    focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    type="url" value="{{ url('/') }}@php echo "/api/lootably?conversion_id={transactionID}&user_id={userID}&point_value={currencyReward}&usd_value={revenue}&offer_title={offerName}&ip={ip}&status={status}&hash={hash}" @endphp">
                            </div>
                        </label>                        
                        
                        <label class="block mt-3">
                            <span>Notik Postback url</span>
                            <div class="flex items-center gap-3">
                                <input
                                    class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400
                                    focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    type="url" value="{{ url('/') }}@php echo "/api/notik?user_id={user_id}&amount={amount}&offer_id={offer_id}&offer_name={offer_name}&payout={payout}&txn_id={txn_id}&hash={hash}" @endphp">
                            </div>
                        </label>  
                        
                        <label class="block mt-3">
                            <span>AdMantum Postback url</span>
                            <div class="flex items-center gap-3">
                                <input
                                    class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400
                                    focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    type="url" value="{{ url('/') }}@php echo "/api/admantum?uid={uid}&of_id={of_id}&of_name={of_name}&virtual_currency={virtual_currency}&status={status}&payout={payout}&transaction_id={transaction_id}&hash={hash}" @endphp">
                            </div>
                        </label>                        
                        
                        <label class="block mt-3">
                            <span>AdscendMedia Postback url</span>
                            <div class="flex items-center gap-3">
                                <input
                                    class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400
                                    focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    type="url" value="{{ url('/') }}@php echo "/api/Adscend?user_id=[SB1]&amount=[CUR]&offer_id=[OID]&offer_name={offer_name}&payout=[PAY]&offer_name=[ONM]&txn_id=[TID]" @endphp">
                            </div>
                        </label>

                    </div>

                </div>
            </div>

    </main>
</x-admin-layout>
