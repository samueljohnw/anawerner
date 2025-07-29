@extends('template.fullwidth')

@section('title', 'My Account | Ana Werner Ministries')

@section('content')
<section class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="column small-12 medium-12">
                <h2>My Account</h2>
                
                @if(session('success'))
                    <div class="callout success">
                        {{ session('success') }}
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="callout alert">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Account Navigation -->
                <div class="tabs-content" data-tabs-content="account-tabs">
                    <!-- Profile Tab -->
                    <div class="tabs-panel is-active" id="profile">
                        <div class="grid-x grid-padding-x">
                            <div class="cell medium-6">
                                <h3>Profile Information</h3>
                                <form method="POST" action="{{ route('account.profile.update') }}">
                                    @csrf
                                    @method('PUT')
                                    
                                    <label>
                                        Name
                                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
                                        @error('name')
                                            <span class="form-error is-visible">{{ $message }}</span>
                                        @enderror
                                    </label>
                                    
                                    <label>
                                        Email
                                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
                                        @error('email')
                                            <span class="form-error is-visible">{{ $message }}</span>
                                        @enderror
                                    </label>
                                    
                                    <button type="submit" class="btn button">Update Profile</button>
                                </form>
                            </div>

                        </div>
                    </div>

                    <!-- Purchases Tab -->


                    <!-- Subscriptions Tab -->
                    <div class="tabs-panel" id="subscriptions">
                        <h3>Active Subscriptions</h3>
                        @if($activeSubscriptions->count() > 0)
                            @foreach($activeSubscriptions as $subscription)
                                <div class="card" style="margin-bottom: 20px;">
                                    <div class="card-section">
                                        <div class="grid-x align-justify">
                                            <div class="cell auto">
                                                <h4>{{ $subscription['type'] }}</h4>
                                                <p><strong>Status:</strong> 
                                                    @if($subscription['is_cancelled'])
                                                        <span class="label alert">Cancelled</span>
                                                    @else
                                                        <span class="label success">{{ ucfirst($subscription['status']) }}</span>
                                                    @endif
                                                </p>
                                                <p><strong>Started:</strong> {{ $subscription['created_at']->format('M j, Y') }}</p>
                                                @if($subscription['is_cancelled'] && $subscription['ends_at'])
                                                    <p><strong>Ends:</strong> {{ $subscription['ends_at']->format('M j, Y') }}</p>
                                                @elseif($subscription['current_period_end'])
                                                    <p><strong>Next Billing:</strong> {{ $subscription['current_period_end']->format('M j, Y') }}</p>
                                                @endif
                                                @if($subscription['cancel_at_period_end'])
                                                    <p class="text-warning"><strong>Cancels at period end</strong></p>
                                                @endif
                                            </div>
                                            <div class="cell shrink">
                                                @if($subscription['cancel_at_period_end'])
                                                    <form method="POST" action="{{ route('account.subscription.resume', $subscription['id']) }}" style="display: inline;">
                                                        @csrf
                                                        <button type="submit" class="button secondary small">Resume</button>
                                                    </form>
                                                @else
                                                    <form method="POST" action="{{ route('account.subscription.cancel', $subscription['id']) }}" style="display: inline;">
                                                        @csrf
                                                        <button type="submit" class="button alert small" onclick="return confirm('Are you sure you want to cancel this subscription?')">Cancel</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>No active subscriptions. <a href="/plans">View subscription plans</a>.</p>
                        @endif

                        @if($pastSubscriptions->count() > 0)
                            <h4>Past Subscriptions</h4>
                            @foreach($pastSubscriptions as $subscription)
                                <div class="card" style="margin-bottom: 20px;">
                                    <div class="card-section">
                                        <h5>{{ $subscription['type'] }}</h5>
                                        <p><strong>Status:</strong> 
                                            <span class="label secondary">{{ ucfirst($subscription['status']) }}</span>
                                        </p>
                                        <p><strong>Started:</strong> {{ $subscription['created_at']->format('M j, Y') }}</p>
                                        @if($subscription['ended_at'])
                                            <p><strong>Ended:</strong> {{ $subscription['ended_at']->format('M j, Y') }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<script>
// Tab functionality
document.addEventListener('DOMContentLoaded', function() {
    // Simple tab implementation
    const tabButtons = document.querySelectorAll('[data-tab]');
    const tabPanels = document.querySelectorAll('.tabs-panel');
    
    // Create tab buttons dynamically
    const tabsContainer = document.createElement('ul');
    tabsContainer.className = 'tabs';
    tabsContainer.setAttribute('data-tabs', 'true');
    tabsContainer.id = 'account-tabs';
    
    const tabs = [
        {id: 'profile', label: 'Profile'},
        {id: 'subscriptions', label: 'Subscriptions'},
    ];
    
    tabs.forEach((tab, index) => {
        const li = document.createElement('li');
        li.className = 'tabs-title' + (index === 0 ? ' is-active' : '');
        const a = document.createElement('a');
        a.href = '#' + tab.id;
        a.setAttribute('aria-selected', index === 0 ? 'true' : 'false');
        a.textContent = tab.label;
        a.addEventListener('click', function(e) {
            e.preventDefault();
            switchTab(tab.id);
        });
        li.appendChild(a);
        tabsContainer.appendChild(li);
    });
    
    // Insert tabs before content
    const contentWrapper = document.querySelector('.content-wrapper .container .row .column');
    const h2 = contentWrapper.querySelector('h2');
    h2.parentNode.insertBefore(tabsContainer, h2.nextSibling);
    
    function switchTab(targetId) {
        // Hide all panels
        tabPanels.forEach(panel => {
            panel.classList.remove('is-active');
        });
        
        // Remove active from all tab titles
        document.querySelectorAll('.tabs-title').forEach(title => {
            title.classList.remove('is-active');
            title.querySelector('a').setAttribute('aria-selected', 'false');
        });
        
        // Show target panel
        const targetPanel = document.getElementById(targetId);
        if (targetPanel) {
            targetPanel.classList.add('is-active');
        }
        
        // Set active tab
        const activeTab = document.querySelector(`a[href="#${targetId}"]`).parentElement;
        activeTab.classList.add('is-active');
        activeTab.querySelector('a').setAttribute('aria-selected', 'true');
    }
    
    // Load invoices
    loadInvoices();
});

function loadInvoices() {
    fetch('{{ route("account.invoices") }}')
        .then(response => response.json())
        .then(invoices => {
            const invoicesList = document.getElementById('invoices-list');
            if (invoices.length > 0) {
                let html = '<div class="grid-x">';
                invoices.forEach(invoice => {
                    html += `
                        <div class="cell small-12 medium-6" style="margin-bottom: 20px;">
                            <div class="card">
                                <div class="card-section">
                                    <h5>Invoice #${invoice.id.substring(0, 8)}</h5>
                                    <p><strong>Date:</strong> ${invoice.date}</p>
                                    <p><strong>Amount:</strong> ${invoice.total}</p>
                                    <p><strong>Status:</strong> <span class="label ${invoice.status === 'paid' ? 'success' : 'secondary'}">${invoice.status}</span></p>
                                    <a href="${invoice.hosted_invoice_url}" target="_blank" class="button small">View Invoice</a>
                                </div>
                            </div>
                        </div>
                    `;
                });
                html += '</div>';
                invoicesList.innerHTML = html;
            } else {
                invoicesList.innerHTML = '<p>No invoices found.</p>';
            }
        })
        .catch(error => {
            console.error('Error loading invoices:', error);
            document.getElementById('invoices-list').innerHTML = '<p>Unable to load invoices.</p>';
        });
}
</script>
@endsection