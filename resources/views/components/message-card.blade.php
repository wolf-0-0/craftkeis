<div class="inner-message-card {{ auth()->user()->id == $message->user_id ? 'user' : '' }}" id="inner-message-card">
    <div class="message-sender">
        <span>{{ $message->users->name }}</span>
    </div>
    <div class="message-content">
        <p>{{ $message->message_content }}</p>
        <span class="message-timestamp">{{ $message->created_at }}</span>
    </div>
</div>

